<?php

namespace App\Jobs;

use App\Models\Bot;
use App\Models\Trade;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class RefreshActiveBots implements ShouldQueue
{
    use Queueable;

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
        /**
         * Fetch all bots with the status of 'active'.
         * TODO:: Find a way to call this query once and periodically refresh to avoid DB timeouts.
         */
        $activeBotSessions = Bot::where('status', 'active')->get();

        /**
         * Get the current datetime and compare this with the timer_checkpoint
         * of each bot.
         */
        if (! $activeBotSessions->isEmpty()) {
            foreach ($activeBotSessions as $bot) {
                $checkpoint = intval($bot['timer_checkpoint']);
                $now = now()->getTimestampMs();

                if ($now > $checkpoint) {
                    /**
                     * Generate new trading asset data and update timer_checkpoint.
                     */
                    $assetToTrade = $this->generateAssetToTrade();
                    $newCheckpoint = Carbon::createFromTimestampMs($checkpoint)->addMinutes(5)->addSeconds(12)->getTimestampMs();
                    $profitPosition = $bot['profit_position'];
                    $profit = json_decode($bot['profit_values'])[$profitPosition];
                    $updatedTotalProfit = $this->normalizeAmount($bot['profit']) + $profit;

                    DB::transaction(function () use ($bot, $assetToTrade, $newCheckpoint, $updatedTotalProfit, $profitPosition, $profit) {
                        Bot::where('id', $bot['id'])->update([
                            'asset' => $assetToTrade['display_name'],
                            'asset_image_url' => $assetToTrade['image_url'],
                            'sentiment' => $assetToTrade['sentiment'],
                            'timer_checkpoint' => strval($newCheckpoint),
                            'profit' => $this->serializeAmount($updatedTotalProfit),
                            'profit_position' => $profitPosition + 1
                        ]);

                        Trade::create([
                            'user_id' => $bot['user_id'],
                            'asset' => $bot['asset'],
                            'asset_image_url' => $bot['asset_image_url'],
                            'account_type' => $bot['account_type'],
                            'profit' => $this->serializeAmount($profit),
                            'sentiment' => $bot['sentiment']
                        ]);
                    });
                }
            }
        }
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
                "assetType" => "coin",
                "symbol" => "BTCUSDT",
                "image" => "btc.svg"
            ],
            [
                "name" => "ETH/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "ETHUSDT",
                "image" => "eth.svg"
            ],
            [
                "name" => "LTC/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "LTCUSDT",
                "image" => "ltc.svg"
            ],
            [
                "name" => "SOL/USDT",
                "percentage" => "98%",
                "assetType" => "coin",
                "symbol" => "SOLUSDT",
                "image" => "sol.svg"
            ],
            [
                "name" => "XRP/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "XRPUSDT",
                "image" => "xrp.svg"
            ],
            [
                "name" => "DOGE/USDT",
                "percentage" => "83%",
                "assetType" => "coin",
                "symbol" => "DOGEUSDT",
                "image" => "doge.svg"
            ],
            [
                "name" => "BCH/USDT",
                "percentage" => "89%",
                "assetType" => "coin",
                "symbol" => "BCHUSDT",
                "image" => "bch.svg"
            ],
            [
                "name" => "DAI/USDT",
                "percentage" => "97%",
                "assetType" => "coin",
                "symbol" => "DAIUSDT",
                "image" => "dai.svg"
            ],
            [
                "name" => "BNB/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "BNBUSDT",
                "image" => "bnb.svg"
            ],
            [
                "name" => "ADA/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "ADAUSDT",
                "image" => "ada.svg"
            ],
            [
                "name" => "AVAX/USDT",
                "percentage" => "99%",
                "assetType" => "coin",
                "symbol" => "AVAXUSDT",
                "image" => "avax.svg"
            ],
            [
                "name" => "TRX/USDT",
                "percentage" => "90%",
                "assetType" => "coin",
                "symbol" => "TRXUSDT",
                "image" => "trx.svg"
            ],
            [
                "name" => "MATIC/USDT",
                "percentage" => "91%",
                "assetType" => "coin",
                "symbol" => "MATICUSDT",
                "image" => "matic.svg"
            ],
            [
                "name" => "ATOM/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "ATOMUSDT",
                "image" => "atom.svg"
            ],
            [
                "name" => "LINK/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "LINKUSDT",
                "image" => "link.svg"
            ],
            [
                "name" => "DASH/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "DASHUSDT",
                "image" => "dash.svg"
            ],
            [
                "name" => "XLM/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "XLMUSDT",
                "image" => "xlm.svg"
            ],
            [
                "name" => "NEO/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "NEOUSDT",
                "image" => "neo.svg"
            ],
            [
                "name" => "BAT/USDT",
                "percentage" => "83%",
                "assetType" => "coin",
                "symbol" => "BATUSDT",
                "image" => "bat.svg"
            ],
            [
                "name" => "ETC/USDT",
                "percentage" => "86%",
                "assetType" => "coin",
                "symbol" => "ETCUSDT",
                "image" => "etc.svg"
            ],
            [
                "name" => "ZEC/USDT",
                "percentage" => "94%",
                "assetType" => "coin",
                "symbol" => "ZECUSDT",
                "image" => "zec.svg"
            ],
            [
                "name" => "ONT/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "ONTUSDT",
                "image" => "ont.svg"
            ],
            [
                "name" => "STX/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "STXUSDT",
                "image" => "stx.svg"
            ],
            [
                "name" => "MKR/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "MKRUSDT",
                "image" => "mkr.svg"
            ],
            [
                "name" => "AAVE/USDT",
                "percentage" => "90%",
                "assetType" => "coin",
                "symbol" => "AAVEUSDT",
                "image" => "aave.svg"
            ],
            [
                "name" => "XMR/USDT",
                "percentage" => "99%",
                "assetType" => "coin",
                "symbol" => "XMRUSDT",
                "image" => "xmr.svg"
            ],
            [
                "name" => "YFI/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "YFIUSDT",
                "image" => "yfi.svg"
            ]
        ];

        $weekdayTradingPair = [
            [
                "name" => "EUR/USD",
                "percentage" => "99%",
                "assetType" => "currency",
                "symbol" => "EURUSD",
                "image" => "EURUSD_OTC.svg"
            ],
            [
                "name" => "AUD/CAD",
                "percentage" => "96%",
                "assetType" => "currency",
                "symbol" => "AUDCAD",
                "image" => "AUDCAD.svg"
            ],
            [
                "name" => "GBP/USD",
                "percentage" => "85%",
                "assetType" => "currency",
                "symbol" => "GBPUSD",
                "image" => "GBPUSD_OTC.svg"
            ],
            [
                "name" => "GBP/NZD",
                "percentage" => "89%",
                "assetType" => "currency",
                "symbol" => "GBPNZD",
                "image" => "GBPNZD.svg"
            ],
            [
                "name" => "USD/JPY",
                "percentage" => "97%",
                "assetType" => "currency",
                "symbol" => "USDJPY",
                "image" => "USDJPY_OTC.svg"
            ],
            [
                "name" => "EUR/GBP",
                "percentage" => "95%",
                "assetType" => "currency",
                "symbol" => "EURGBP",
                "image" => "EURGBP.svg"
            ],
            [
                "name" => "GBP/CHF",
                "percentage" => "90%",
                "assetType" => "currency",
                "symbol" => "GBPCHF",
                "image" => "GBPCHF.svg"
            ],
            [
                "name" => "GBP/CAD",
                "percentage" => "88%",
                "assetType" => "currency",
                "symbol" => "GBPCAD",
                "image" => "GBPCAD.svg"
            ],
            [
                "name" => "NASDAQ",
                "percentage" => "92%",
                "assetType" => "currency",
                "symbol" => "NQ",
                "image" => "NQ.svg"
            ],
            [
                "name" => "AUD/JPY",
                "percentage" => "93%",
                "assetType" => "currency",
                "symbol" => "AUDJPY",
                "image" => "AUDJPY.svg"
            ],
            [
                "name" => "CAD/CHF",
                "percentage" => "77%",
                "assetType" => "currency",
                "symbol" => "CADCHF",
                "image" => "CADCHF.svg"
            ],
            [
                "name" => "CAD/JPY",
                "percentage" => "85%",
                "assetType" => "currency",
                "symbol" => "CADJPY",
                "image" => "CADJPY.svg"
            ],
            [
                "name" => "EUR/AUD",
                "percentage" => "97%",
                "assetType" => "currency",
                "symbol" => "EURAUD",
                "image" => "EURAUD.svg"
            ],
            [
                "name" => "EUR/JPY",
                "percentage" => "91%",
                "assetType" => "currency",
                "symbol" => "EURJPY",
                "image" => "EURJPY.svg"
            ],
            [
                "name" => "EUR/CAD",
                "percentage" => "99%",
                "assetType" => "currency",
                "symbol" => "EURCAD",
                "image" => "EURCAD.svg"
            ],
            [
                "name" => "GPB/JPY",
                "percentage" => "83%",
                "assetType" => "currency",
                "symbol" => "GBPJPY",
                "image" => "GBPJPY.svg"
            ],
            [
                "name" => "NZD/CAD",
                "percentage" => "90%",
                "assetType" => "currency",
                "symbol" => "NZDCAD",
                "image" => "NZDCAD.svg"
            ],
            [
                "name" => "NZD/CHF",
                "percentage" => "98%",
                "assetType" => "currency",
                "symbol" => "NZDCHF",
                "image" => "NZDCHF.svg"
            ],
            [
                "name" => "NZD/JPY",
                "percentage" => "95%",
                "assetType" => "currency",
                "symbol" => "NZDJPY",
                "image" => "NZDJPY.svg"
            ],
            [
                "name" => "USD/MXN",
                "percentage" => "95%",
                "assetType" => "currency",
                "symbol" => "USDMXN",
                "image" => "USDMXN.svg"
            ],
            [
                "name" => "USD/SGD",
                "percentage" => "98%",
                "assetType" => "currency",
                "symbol" => "USDSGD",
                "image" => "USDSGD.svg"
            ],
            [
                "name" => "NZD/USD",
                "percentage" => "96%",
                "assetType" => "currency",
                "symbol" => "NZDUSD",
                "image" => "NZDUSD_OTC.svg"
            ],
            [
                "name" => "USD/CHF",
                "percentage" => "91%",
                "assetType" => "currency",
                "symbol" => "USDCHF",
                "image" => "USDCHF_OTC.svg"
            ],
            [
                "name" => "AUD/CHF",
                "percentage" => "96%",
                "assetType" => "currency",
                "symbol" => "AUDCHF",
                "image" => "AUDCHF.svg"
            ],
            [
                "name" => "CHF/JPY",
                "percentage" => "99%",
                "assetType" => "currency",
                "symbol" => "CHFJPY",
                "image" => "CHFJPY.svg"
            ],
            [
                "name" => "BTC/USDT",
                "percentage" => "91%",
                "assetType" => "coin",
                "symbol" => "BTCUSDT",
                "image" => "btc.svg"
            ],
            [
                "name" => "ETH/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "ETHUSDT",
                "image" => "eth.svg"
            ],
            [
                "name" => "LTC/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "LTCUSDT",
                "image" => "ltc.svg"
            ],
            [
                "name" => "SOL/USDT",
                "percentage" => "98%",
                "assetType" => "coin",
                "symbol" => "SOLUSDT",
                "image" => "sol.svg"
            ],
            [
                "name" => "XRP/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "XRPUSDT",
                "image" => "xrp.svg"
            ],
            [
                "name" => "DOGE/USDT",
                "percentage" => "83%",
                "assetType" => "coin",
                "symbol" => "DOGEUSDT",
                "image" => "doge.svg"
            ],
            [
                "name" => "BCH/USDT",
                "percentage" => "89%",
                "assetType" => "coin",
                "symbol" => "BCHUSDT",
                "image" => "bch.svg"
            ],
            [
                "name" => "DAI/USDT",
                "percentage" => "97%",
                "assetType" => "coin",
                "symbol" => "DAIUSDT",
                "image" => "dai.svg"
            ],
            [
                "name" => "BNB/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "BNBUSDT",
                "image" => "bnb.svg"
            ],
            [
                "name" => "ADA/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "ADAUSDT",
                "image" => "ada.svg"
            ],
            [
                "name" => "AVAX/USDT",
                "percentage" => "99%",
                "assetType" => "coin",
                "symbol" => "AVAXUSDT",
                "image" => "avax.svg"
            ],
            [
                "name" => "TRX/USDT",
                "percentage" => "90%",
                "assetType" => "coin",
                "symbol" => "TRXUSDT",
                "image" => "trx.svg"
            ],
            [
                "name" => "MATIC/USDT",
                "percentage" => "91%",
                "assetType" => "coin",
                "symbol" => "MATICUSDT",
                "image" => "matic.svg"
            ],
            [
                "name" => "ATOM/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "ATOMUSDT",
                "image" => "atom.svg"
            ],
            [
                "name" => "LINK/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "LINKUSDT",
                "image" => "link.svg"
            ],
            [
                "name" => "DASH/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "DASHUSDT",
                "image" => "dash.svg"
            ],
            [
                "name" => "XLM/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "XLMUSDT",
                "image" => "xlm.svg"
            ],
            [
                "name" => "NEO/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "NEOUSDT",
                "image" => "neo.svg"
            ],
            [
                "name" => "BAT/USDT",
                "percentage" => "83%",
                "assetType" => "coin",
                "symbol" => "BATUSDT",
                "image" => "bat.svg"
            ],
            [
                "name" => "ETC/USDT",
                "percentage" => "86%",
                "assetType" => "coin",
                "symbol" => "ETCUSDT",
                "image" => "etc.svg"
            ],
            [
                "name" => "ZEC/USDT",
                "percentage" => "94%",
                "assetType" => "coin",
                "symbol" => "ZECUSDT",
                "image" => "zec.svg"
            ],
            [
                "name" => "ONT/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "ONTUSDT",
                "image" => "ont.svg"
            ],
            [
                "name" => "STX/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "STXUSDT",
                "image" => "stx.svg"
            ],
            [
                "name" => "MKR/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "MKRUSDT",
                "image" => "mkr.svg"
            ],
            [
                "name" => "AAVE/USDT",
                "percentage" => "90%",
                "assetType" => "coin",
                "symbol" => "AAVEUSDT",
                "image" => "aave.svg"
            ],
            [
                "name" => "XMR/USDT",
                "percentage" => "99%",
                "assetType" => "coin",
                "symbol" => "XMRUSDT",
                "image" => "xmr.svg"
            ],
            [
                "name" => "YFI/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
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
                'percentage' => $weekdayTradingPair[$asset]['percentage'],
                'image_url' => "assets/icons/dashboard/" . $weekdayTradingPair[$asset]['image'],
                'type' => 'coin',
                'sentiment' => $sentiment,
            ];
        } else {
            $asset = rand(0, count($weekendTradingPair) - 1);
            return [
                'ticker_symbol' => $weekendTradingPair[$asset]['symbol'],
                'display_name' => $weekendTradingPair[$asset]['name'],
                'percentage' => $weekendTradingPair[$asset]['percentage'],
                'image_url' => "assets/icons/dashboard/" . $weekendTradingPair[$asset]['image'],
                'type' => 'coin',
                'sentiment' => $sentiment,
            ];
        }
    }
}
