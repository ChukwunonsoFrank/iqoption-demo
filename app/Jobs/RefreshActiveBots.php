<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Bot;
use App\Models\User;
use App\Models\Trade;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshActiveBots implements ShouldQueue
{
    use Queueable;

    /**
     * The number of seconds the job can run before timing out.
     * Prevents long-running jobs from overlapping if the lock fails.
     */
    public int $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $now = now();
        $nowMs = $now->getTimestampMs();

        $botsToExpire = [];
        $userBalancesToUpdate = [];
        $tradesToCreate = [];
        $botsForCheckpointUpdate = [];

        // 1. Collect data by iterating through bots once.
        Bot::with(['user:id,demo_balance,live_balance'])
            ->where('status', 'active')
            ->chunk(200, function ($bots) use ($now, $nowMs, &$botsToExpire, &$userBalancesToUpdate, &$tradesToCreate, &$botsForCheckpointUpdate) {
                foreach ($bots as $bot) {
                    // --- Handle Bot Expiration ---
                    if ($nowMs > intval($bot->end)) {
                        $botsToExpire[] = $bot->id;
                        $profit = $this->normalizeAmount($bot->profit);
                        $amount = $this->normalizeAmount($bot->amount);
                        $currentBalance = $this->normalizeAmount(
                            $bot->account_type === 'demo' ? $bot->user->demo_balance : $bot->user->live_balance
                        );
                        $newBalance = $currentBalance + $amount + $profit;

                        if (!isset($userBalancesToUpdate[$bot->user->id])) {
                            $userBalancesToUpdate[$bot->user->id] = ['live' => null, 'demo' => null];
                        }
                        $userBalancesToUpdate[$bot->user->id][$bot->account_type] = $this->serializeAmount($newBalance);

                        continue; // Expired bots don't need a checkpoint update.
                    }

                    // --- Handle Bot Checkpoint Update ---
                    if ($nowMs > intval($bot->timer_checkpoint)) {
                        $assetToTrade = $this->generateAssetToTrade($now->isWeekday());
                        $profitPosition = $bot->profit_position;
                        $profitValue = json_decode($bot->profit_values, true)[$profitPosition] ?? 0;
                        $updatedTotalProfit = $this->normalizeAmount($bot->profit) + $profitValue;

                        $botsForCheckpointUpdate[$bot->id] = [
                            'asset' => $assetToTrade['display_name'],
                            'asset_class' => $assetToTrade['asset_class'],
                            'asset_ticker' => $assetToTrade['ticker_symbol'],
                            'asset_image_url' => $assetToTrade['image_url'],
                            'sentiment' => $assetToTrade['sentiment'],
                            'timer_checkpoint' => strval(Carbon::createFromTimestampMs($bot->timer_checkpoint)->addMinutes(5)->addSeconds(8)->getTimestampMs()),
                            'profit' => $this->serializeAmount($updatedTotalProfit),
                            'profit_position' => $profitPosition + 1,
                        ];

                        $tradesToCreate[] = [
                            'user_id' => $bot->user_id,
                            'asset' => $assetToTrade['display_name'],
                            'asset_image_url' => $assetToTrade['image_url'],
                            'account_type' => $bot->account_type,
                            'profit' => $this->serializeAmount($profitValue),
                            'sentiment' => $assetToTrade['sentiment'],
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                }
            });

        // 2. Perform all collected DB operations in a single transaction.
        if (!empty($botsToExpire) || !empty($userBalancesToUpdate) || !empty($botsForCheckpointUpdate) || !empty($tradesToCreate)) {
            DB::transaction(function () use ($botsToExpire, $userBalancesToUpdate, $botsForCheckpointUpdate, $tradesToCreate) {
                $this->expireBotsInBulk($botsToExpire);
                $this->updateUserBalancesInBulk($userBalancesToUpdate);
                $this->updateBotCheckpointsInBulk($botsForCheckpointUpdate);
                $this->createTradesInBulk($tradesToCreate);
            });
        }
    }

    // --- Bulk Operation Helper Methods ---

    private function expireBotsInBulk(array $botIds): void
    {
        if (empty($botIds)) {
            return;
        }
        Bot::whereIn('id', $botIds)->update(['status' => 'expired']);
    }

    private function createTradesInBulk(array $tradesData): void
    {
        if (empty($tradesData)) {
            return;
        }
        Trade::insert($tradesData);
    }

    private function updateUserBalancesInBulk(array $updates): void
    {
        if (empty($updates)) {
            return;
        }

        $demoUpdates = array_filter(array_column($updates, 'demo'));
        $liveUpdates = array_filter(array_column($updates, 'live'));

        if (!empty($demoUpdates)) {
            $this->performBulkUpdate('users', $demoUpdates, 'demo_balance');
        }
        if (!empty($liveUpdates)) {
            $this->performBulkUpdate('users', $liveUpdates, 'live_balance');
        }
    }

    private function updateBotCheckpointsInBulk(array $updates): void
    {
        if (empty($updates)) {
            return;
        }

        // Each column to update needs its own CASE statement.
        $columnsToUpdate = [
            'asset',
            'asset_class',
            'asset_ticker',
            'asset_image_url',
            'sentiment',
            'timer_checkpoint',
            'profit',
            'profit_position'
        ];

        $updateDataByColumn = [];
        foreach ($columnsToUpdate as $column) {
            $updateDataByColumn[$column] = array_column($updates, $column, 'id');
        }

        $this->performBulkUpdate('bots', $updates, $columnsToUpdate);
    }

    /**
     * Performs a bulk update using a raw SQL CASE statement.
     * Can handle single or multiple column updates.
     */
    private function performBulkUpdate(string $table, array $values, $columns): void
    {
        if (empty($values)) {
            return;
        }

        $cases = [];
        $bindings = [];
        $ids = [];

        $columns = is_array($columns) ? $columns : [$columns];
        $firstValue = reset($values);
        $idColumn = 'id'; // Assuming 'id' is the key.

        foreach ($columns as $column) {
            $caseSql = "`$column` = CASE `$idColumn` ";
            foreach ($values as $id => $value) {
                $caseSql .= "WHEN ? THEN ? ";
                array_push($bindings, $id, is_array($value) ? $value[$column] : $value);
            }
            $caseSql .= "ELSE `$column` END";
            $cases[] = $caseSql;
        }

        $ids = array_keys($values);
        $updateSql = "UPDATE `$table` SET " . implode(', ', $cases) . " WHERE `$idColumn` IN (" . rtrim(str_repeat('?,', count($ids)), ',') . ")";
        $bindings = array_merge($bindings, $ids);

        DB::update($updateSql, $bindings);
    }

    public function normalizeAmount(int $amount): int | float
    {
        return $amount / 100;
    }

    public function serializeAmount(float $amount): int
    {
        return $amount * 100;
    }

    /**
     * Generate new assets.
     */
    public function generateAssetToTrade()
    {
        $weekendTradingPair = [
            [
                "name" => "BTC/USDT",
                "percentage" => "91%",
                "assetType" => "crypto",
                "symbol" => "BTCUSDT",
                "image" => "btc.svg"
            ],
            [
                "name" => "ETH/USDT",
                "percentage" => "95%",
                "assetType" => "crypto",
                "symbol" => "ETHUSDT",
                "image" => "eth.svg"
            ],
            [
                "name" => "LTC/USDT",
                "percentage" => "95%",
                "assetType" => "crypto",
                "symbol" => "LTCUSDT",
                "image" => "ltc.svg"
            ],
            [
                "name" => "SOL/USDT",
                "percentage" => "98%",
                "assetType" => "crypto",
                "symbol" => "SOLUSDT",
                "image" => "sol.svg"
            ],
            [
                "name" => "XRP/USDT",
                "percentage" => "93%",
                "assetType" => "crypto",
                "symbol" => "XRPUSDT",
                "image" => "xrp.svg"
            ],
            [
                "name" => "DOGE/USDT",
                "percentage" => "83%",
                "assetType" => "crypto",
                "symbol" => "DOGEUSDT",
                "image" => "doge.svg"
            ],
            [
                "name" => "BCH/USDT",
                "percentage" => "89%",
                "assetType" => "crypto",
                "symbol" => "BCHUSDT",
                "image" => "bch.svg"
            ],
            [
                "name" => "DAI/USDT",
                "percentage" => "97%",
                "assetType" => "crypto",
                "symbol" => "DAIUSDT",
                "image" => "dai.svg"
            ],
            [
                "name" => "BNB/USDT",
                "percentage" => "87%",
                "assetType" => "crypto",
                "symbol" => "BNBUSDT",
                "image" => "bnb.svg"
            ],
            [
                "name" => "ADA/USDT",
                "percentage" => "93%",
                "assetType" => "crypto",
                "symbol" => "ADAUSDT",
                "image" => "ada.svg"
            ],
            [
                "name" => "AVAX/USDT",
                "percentage" => "99%",
                "assetType" => "crypto",
                "symbol" => "AVAXUSDT",
                "image" => "avax.svg"
            ],
            [
                "name" => "TRX/USDT",
                "percentage" => "90%",
                "assetType" => "crypto",
                "symbol" => "TRXUSDT",
                "image" => "trx.svg"
            ],
            [
                "name" => "MATIC/USDT",
                "percentage" => "91%",
                "assetType" => "crypto",
                "symbol" => "MATICUSDT",
                "image" => "matic.svg"
            ],
            [
                "name" => "ATOM/USDT",
                "percentage" => "96%",
                "assetType" => "crypto",
                "symbol" => "ATOMUSDT",
                "image" => "atom.svg"
            ],
            [
                "name" => "LINK/USDT",
                "percentage" => "87%",
                "assetType" => "crypto",
                "symbol" => "LINKUSDT",
                "image" => "link.svg"
            ],
            [
                "name" => "DASH/USDT",
                "percentage" => "87%",
                "assetType" => "crypto",
                "symbol" => "DASHUSDT",
                "image" => "dash.svg"
            ],
            [
                "name" => "XLM/USDT",
                "percentage" => "93%",
                "assetType" => "crypto",
                "symbol" => "XLMUSDT",
                "image" => "xlm.svg"
            ],
            [
                "name" => "NEO/USDT",
                "percentage" => "93%",
                "assetType" => "crypto",
                "symbol" => "NEOUSDT",
                "image" => "neo.svg"
            ],
            [
                "name" => "BAT/USDT",
                "percentage" => "83%",
                "assetType" => "crypto",
                "symbol" => "BATUSDT",
                "image" => "bat.svg"
            ],
            [
                "name" => "ETC/USDT",
                "percentage" => "86%",
                "assetType" => "crypto",
                "symbol" => "ETCUSDT",
                "image" => "etc.svg"
            ],
            [
                "name" => "ZEC/USDT",
                "percentage" => "94%",
                "assetType" => "crypto",
                "symbol" => "ZECUSDT",
                "image" => "zec.svg"
            ],
            [
                "name" => "ONT/USDT",
                "percentage" => "96%",
                "assetType" => "crypto",
                "symbol" => "ONTUSDT",
                "image" => "ont.svg"
            ],
            [
                "name" => "STX/USDT",
                "percentage" => "96%",
                "assetType" => "crypto",
                "symbol" => "STXUSDT",
                "image" => "stx.svg"
            ],
            [
                "name" => "MKR/USDT",
                "percentage" => "95%",
                "assetType" => "crypto",
                "symbol" => "MKRUSDT",
                "image" => "mkr.svg"
            ],
            [
                "name" => "AAVE/USDT",
                "percentage" => "90%",
                "assetType" => "crypto",
                "symbol" => "AAVEUSDT",
                "image" => "aave.svg"
            ],
            [
                "name" => "XMR/USDT",
                "percentage" => "99%",
                "assetType" => "crypto",
                "symbol" => "XMRUSDT",
                "image" => "xmr.svg"
            ],
            [
                "name" => "YFI/USDT",
                "percentage" => "95%",
                "assetType" => "crypto",
                "symbol" => "YFIUSDT",
                "image" => "yfi.svg"
            ]
        ];

        $weekdayTradingPair = [
            [
                "name" => "EUR/USD",
                "percentage" => "99%",
                "assetType" => "forex",
                "symbol" => "EURUSD",
                "image" => "EURUSD_OTC.svg"
            ],
            [
                "name" => "AUD/CAD",
                "percentage" => "96%",
                "assetType" => "forex",
                "symbol" => "AUDCAD",
                "image" => "AUDCAD.svg"
            ],
            [
                "name" => "GBP/USD",
                "percentage" => "85%",
                "assetType" => "forex",
                "symbol" => "GBPUSD",
                "image" => "GBPUSD_OTC.svg"
            ],
            [
                "name" => "GBP/NZD",
                "percentage" => "89%",
                "assetType" => "forex",
                "symbol" => "GBPNZD",
                "image" => "GBPNZD.svg"
            ],
            [
                "name" => "USD/JPY",
                "percentage" => "97%",
                "assetType" => "forex",
                "symbol" => "USDJPY",
                "image" => "USDJPY_OTC.svg"
            ],
            [
                "name" => "EUR/GBP",
                "percentage" => "95%",
                "assetType" => "forex",
                "symbol" => "EURGBP",
                "image" => "EURGBP.svg"
            ],
            [
                "name" => "GBP/CHF",
                "percentage" => "90%",
                "assetType" => "forex",
                "symbol" => "GBPCHF",
                "image" => "GBPCHF.svg"
            ],
            [
                "name" => "GBP/CAD",
                "percentage" => "88%",
                "assetType" => "forex",
                "symbol" => "GBPCAD",
                "image" => "GBPCAD.svg"
            ],
            [
                "name" => "NASDAQ",
                "percentage" => "92%",
                "assetType" => "forex",
                "symbol" => "NQ",
                "image" => "NQ.svg"
            ],
            [
                "name" => "AUD/JPY",
                "percentage" => "93%",
                "assetType" => "forex",
                "symbol" => "AUDJPY",
                "image" => "AUDJPY.svg"
            ],
            [
                "name" => "CAD/CHF",
                "percentage" => "77%",
                "assetType" => "forex",
                "symbol" => "CADCHF",
                "image" => "CADCHF.svg"
            ],
            [
                "name" => "CAD/JPY",
                "percentage" => "85%",
                "assetType" => "forex",
                "symbol" => "CADJPY",
                "image" => "CADJPY.svg"
            ],
            [
                "name" => "EUR/AUD",
                "percentage" => "97%",
                "assetType" => "forex",
                "symbol" => "EURAUD",
                "image" => "EURAUD.svg"
            ],
            [
                "name" => "EUR/JPY",
                "percentage" => "91%",
                "assetType" => "forex",
                "symbol" => "EURJPY",
                "image" => "EURJPY.svg"
            ],
            [
                "name" => "EUR/CAD",
                "percentage" => "99%",
                "assetType" => "forex",
                "symbol" => "EURCAD",
                "image" => "EURCAD.svg"
            ],
            [
                "name" => "GPB/JPY",
                "percentage" => "83%",
                "assetType" => "forex",
                "symbol" => "GBPJPY",
                "image" => "GBPJPY.svg"
            ],
            [
                "name" => "NZD/CAD",
                "percentage" => "90%",
                "assetType" => "forex",
                "symbol" => "NZDCAD",
                "image" => "NZDCAD.svg"
            ],
            [
                "name" => "NZD/CHF",
                "percentage" => "98%",
                "assetType" => "forex",
                "symbol" => "NZDCHF",
                "image" => "NZDCHF.svg"
            ],
            [
                "name" => "NZD/JPY",
                "percentage" => "95%",
                "assetType" => "forex",
                "symbol" => "NZDJPY",
                "image" => "NZDJPY.svg"
            ],
            [
                "name" => "USD/MXN",
                "percentage" => "95%",
                "assetType" => "forex",
                "symbol" => "USDMXN",
                "image" => "USDMXN.svg"
            ],
            [
                "name" => "USD/SGD",
                "percentage" => "98%",
                "assetType" => "forex",
                "symbol" => "USDSGD",
                "image" => "USDSGD.svg"
            ],
            [
                "name" => "NZD/USD",
                "percentage" => "96%",
                "assetType" => "forex",
                "symbol" => "NZDUSD",
                "image" => "NZDUSD_OTC.svg"
            ],
            [
                "name" => "USD/CHF",
                "percentage" => "91%",
                "assetType" => "forex",
                "symbol" => "USDCHF",
                "image" => "USDCHF_OTC.svg"
            ],
            [
                "name" => "AUD/CHF",
                "percentage" => "96%",
                "assetType" => "forex",
                "symbol" => "AUDCHF",
                "image" => "AUDCHF.svg"
            ],
            [
                "name" => "CHF/JPY",
                "percentage" => "99%",
                "assetType" => "forex",
                "symbol" => "CHFJPY",
                "image" => "CHFJPY.svg"
            ],
            [
                "name" => "BTC/USDT",
                "percentage" => "91%",
                "assetType" => "crypto",
                "symbol" => "BTCUSDT",
                "image" => "btc.svg"
            ],
            [
                "name" => "ETH/USDT",
                "percentage" => "95%",
                "assetType" => "crypto",
                "symbol" => "ETHUSDT",
                "image" => "eth.svg"
            ],
            [
                "name" => "LTC/USDT",
                "percentage" => "95%",
                "assetType" => "crypto",
                "symbol" => "LTCUSDT",
                "image" => "ltc.svg"
            ],
            [
                "name" => "SOL/USDT",
                "percentage" => "98%",
                "assetType" => "crypto",
                "symbol" => "SOLUSDT",
                "image" => "sol.svg"
            ],
            [
                "name" => "XRP/USDT",
                "percentage" => "93%",
                "assetType" => "crypto",
                "symbol" => "XRPUSDT",
                "image" => "xrp.svg"
            ],
            [
                "name" => "DOGE/USDT",
                "percentage" => "83%",
                "assetType" => "crypto",
                "symbol" => "DOGEUSDT",
                "image" => "doge.svg"
            ],
            [
                "name" => "BCH/USDT",
                "percentage" => "89%",
                "assetType" => "crypto",
                "symbol" => "BCHUSDT",
                "image" => "bch.svg"
            ],
            [
                "name" => "DAI/USDT",
                "percentage" => "97%",
                "assetType" => "crypto",
                "symbol" => "DAIUSDT",
                "image" => "dai.svg"
            ],
            [
                "name" => "BNB/USDT",
                "percentage" => "87%",
                "assetType" => "crypto",
                "symbol" => "BNBUSDT",
                "image" => "bnb.svg"
            ],
            [
                "name" => "ADA/USDT",
                "percentage" => "93%",
                "assetType" => "crypto",
                "symbol" => "ADAUSDT",
                "image" => "ada.svg"
            ],
            [
                "name" => "AVAX/USDT",
                "percentage" => "99%",
                "assetType" => "crypto",
                "symbol" => "AVAXUSDT",
                "image" => "avax.svg"
            ],
            [
                "name" => "TRX/USDT",
                "percentage" => "90%",
                "assetType" => "crypto",
                "symbol" => "TRXUSDT",
                "image" => "trx.svg"
            ],
            [
                "name" => "MATIC/USDT",
                "percentage" => "91%",
                "assetType" => "crypto",
                "symbol" => "MATICUSDT",
                "image" => "matic.svg"
            ],
            [
                "name" => "ATOM/USDT",
                "percentage" => "96%",
                "assetType" => "crypto",
                "symbol" => "ATOMUSDT",
                "image" => "atom.svg"
            ],
            [
                "name" => "LINK/USDT",
                "percentage" => "87%",
                "assetType" => "crypto",
                "symbol" => "LINKUSDT",
                "image" => "link.svg"
            ],
            [
                "name" => "DASH/USDT",
                "percentage" => "87%",
                "assetType" => "crypto",
                "symbol" => "DASHUSDT",
                "image" => "dash.svg"
            ],
            [
                "name" => "XLM/USDT",
                "percentage" => "93%",
                "assetType" => "crypto",
                "symbol" => "XLMUSDT",
                "image" => "xlm.svg"
            ],
            [
                "name" => "NEO/USDT",
                "percentage" => "93%",
                "assetType" => "crypto",
                "symbol" => "NEOUSDT",
                "image" => "neo.svg"
            ],
            [
                "name" => "BAT/USDT",
                "percentage" => "83%",
                "assetType" => "crypto",
                "symbol" => "BATUSDT",
                "image" => "bat.svg"
            ],
            [
                "name" => "ETC/USDT",
                "percentage" => "86%",
                "assetType" => "crypto",
                "symbol" => "ETCUSDT",
                "image" => "etc.svg"
            ],
            [
                "name" => "ZEC/USDT",
                "percentage" => "94%",
                "assetType" => "crypto",
                "symbol" => "ZECUSDT",
                "image" => "zec.svg"
            ],
            [
                "name" => "ONT/USDT",
                "percentage" => "96%",
                "assetType" => "crypto",
                "symbol" => "ONTUSDT",
                "image" => "ont.svg"
            ],
            [
                "name" => "STX/USDT",
                "percentage" => "96%",
                "assetType" => "crypto",
                "symbol" => "STXUSDT",
                "image" => "stx.svg"
            ],
            [
                "name" => "MKR/USDT",
                "percentage" => "95%",
                "assetType" => "crypto",
                "symbol" => "MKRUSDT",
                "image" => "mkr.svg"
            ],
            [
                "name" => "AAVE/USDT",
                "percentage" => "90%",
                "assetType" => "crypto",
                "symbol" => "AAVEUSDT",
                "image" => "aave.svg"
            ],
            [
                "name" => "XMR/USDT",
                "percentage" => "99%",
                "assetType" => "crypto",
                "symbol" => "XMRUSDT",
                "image" => "xmr.svg"
            ],
            [
                "name" => "YFI/USDT",
                "percentage" => "95%",
                "assetType" => "crypto",
                "symbol" => "YFIUSDT",
                "image" => "yfi.svg"
            ]
        ];

        $randomSeed = mt_rand(1, 20);

        $sentiment = $randomSeed % 2 === 0 ? 'BUY' : 'SELL';

        if (now()->isWeekday()) {
            $asset = rand(0, count($weekdayTradingPair) - 1);
            return [
                'ticker_symbol' => $weekdayTradingPair[$asset]['symbol'],
                'display_name' => $weekdayTradingPair[$asset]['name'],
                'asset_class' => $weekdayTradingPair[$asset]['assetType'],
                'image_url' => "assets/icons/dashboard/" . $weekdayTradingPair[$asset]['image'],
                'sentiment' => $sentiment,
            ];
        } else {
            $asset = rand(0, count($weekendTradingPair) - 1);
            return [
                'ticker_symbol' => $weekendTradingPair[$asset]['symbol'],
                'display_name' => $weekendTradingPair[$asset]['name'],
                'asset_class' => $weekendTradingPair[$asset]['assetType'],
                'image_url' => "assets/icons/dashboard/" . $weekendTradingPair[$asset]['image'],
                'sentiment' => $sentiment,
            ];
        }
    }
}
