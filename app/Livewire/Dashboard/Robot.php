<?php

namespace App\Livewire\Dashboard;

use App\Models\Bot;
use App\Models\Strategy;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]

class Robot extends Component
{
    public string $amount = '';

    public int $duration = 5;

    public string $accountType = 'Demo account';

    public string $accountTypeSlug = 'demo';

    public $strategy = [];

    public $strategies = [];

    public function mount()
    {
        if (session()->has('message')) {
            $message = session()->get('message');
            $this->dispatch('robot-stopped', message: $message)->self();
        }

        $this->strategies = Strategy::all();
        $this->strategy = $this->strategies[0];
    }

    public function selectAccountType(string $accountType, string $accountTypeSlug): void
    {
        $this->accountType = $accountType;
        $this->accountTypeSlug = $accountTypeSlug;
    }

    public function generateAssetToTrade()
    {
        $weekendTradingPair = [
            [
                "name" => "BTC/USDT",
                "percentage" => "91%",
                "assetType" => "coin",
                "symbol" => "BTCUSDT",
                "image" => "btc.png"
            ],
            [
                "name" => "ETH/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "ETHUSDT",
                "image" => "eth.png"
            ],
            [
                "name" => "LTC/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "LTCUSDT",
                "image" => "ltc.png"
            ],
            [
                "name" => "SOL/USDT",
                "percentage" => "98%",
                "assetType" => "coin",
                "symbol" => "SOLUSDT",
                "image" => "sol.png"
            ],
            [
                "name" => "XRP/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "XRPUSDT",
                "image" => "xrp.png"
            ],
            [
                "name" => "DOGE/USDT",
                "percentage" => "83%",
                "assetType" => "coin",
                "symbol" => "DOGEUSDT",
                "image" => "doge.png"
            ],
            [
                "name" => "BCH/USDT",
                "percentage" => "89%",
                "assetType" => "coin",
                "symbol" => "BCHUSDT",
                "image" => "bch.png"
            ],
            [
                "name" => "DAI/USDT",
                "percentage" => "97%",
                "assetType" => "coin",
                "symbol" => "DAIUSDT",
                "image" => "dai.png"
            ],
            [
                "name" => "BNB/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "BNBUSDT",
                "image" => "bnb.png"
            ],
            [
                "name" => "ADA/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "ADAUSDT",
                "image" => "ada.png"
            ],
            [
                "name" => "AVAX/USDT",
                "percentage" => "99%",
                "assetType" => "coin",
                "symbol" => "AVAXUSDT",
                "image" => "avax.png"
            ],
            [
                "name" => "TRX/USDT",
                "percentage" => "90%",
                "assetType" => "coin",
                "symbol" => "TRXUSDT",
                "image" => "trx.png"
            ],
            [
                "name" => "MATIC/USDT",
                "percentage" => "91%",
                "assetType" => "coin",
                "symbol" => "MATICUSDT",
                "image" => "matic.png"
            ],
            [
                "name" => "ATOM/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "ATOMUSDT",
                "image" => "atom.png"
            ],
            [
                "name" => "LINK/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "LINKUSDT",
                "image" => "link.png"
            ],
            [
                "name" => "DASH/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "DASHUSDT",
                "image" => "dash.png"
            ],
            [
                "name" => "XLM/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "XLMUSDT",
                "image" => "xlm.png"
            ],
            [
                "name" => "NEO/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "NEOUSDT",
                "image" => "neo.png"
            ],
            [
                "name" => "BAT/USDT",
                "percentage" => "83%",
                "assetType" => "coin",
                "symbol" => "BATUSDT",
                "image" => "bat.png"
            ],
            [
                "name" => "ETC/USDT",
                "percentage" => "86%",
                "assetType" => "coin",
                "symbol" => "ETCUSDT",
                "image" => "etc.png"
            ],
            [
                "name" => "ZEC/USDT",
                "percentage" => "94%",
                "assetType" => "coin",
                "symbol" => "ZECUSDT",
                "image" => "zec.png"
            ],
            [
                "name" => "ONT/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "ONTUSDT",
                "image" => "ont.png"
            ],
            [
                "name" => "STX/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "STXUSDT",
                "image" => "stx.png"
            ],
            [
                "name" => "MKR/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "MKRUSDT",
                "image" => "mkr.png"
            ],
            [
                "name" => "AAVE/USDT",
                "percentage" => "90%",
                "assetType" => "coin",
                "symbol" => "AAVEUSDT",
                "image" => "aave.png"
            ],
            [
                "name" => "XMR/USDT",
                "percentage" => "99%",
                "assetType" => "coin",
                "symbol" => "XMRUSDT",
                "image" => "xmr.png"
            ],
            [
                "name" => "YFI/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "YFIUSDT",
                "image" => "yfi.png"
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
                "name" => "CAC 40",
                "percentage" => "94%",
                "assetType" => "currency",
                "symbol" => "CAC40",
                "image" => "FCE.svg"
            ],
            [
                "name" => "FTSE 100",
                "percentage" => "96%",
                "assetType" => "currency",
                "symbol" => "FTSE",
                "image" => "Z.svg"
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
                "image" => "btc.png"
            ],
            [
                "name" => "ETH/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "ETHUSDT",
                "image" => "eth.png"
            ],
            [
                "name" => "LTC/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "LTCUSDT",
                "image" => "ltc.png"
            ],
            [
                "name" => "SOL/USDT",
                "percentage" => "98%",
                "assetType" => "coin",
                "symbol" => "SOLUSDT",
                "image" => "sol.png"
            ],
            [
                "name" => "XRP/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "XRPUSDT",
                "image" => "xrp.png"
            ],
            [
                "name" => "DOGE/USDT",
                "percentage" => "83%",
                "assetType" => "coin",
                "symbol" => "DOGEUSDT",
                "image" => "doge.png"
            ],
            [
                "name" => "BCH/USDT",
                "percentage" => "89%",
                "assetType" => "coin",
                "symbol" => "BCHUSDT",
                "image" => "bch.png"
            ],
            [
                "name" => "DAI/USDT",
                "percentage" => "97%",
                "assetType" => "coin",
                "symbol" => "DAIUSDT",
                "image" => "dai.png"
            ],
            [
                "name" => "BNB/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "BNBUSDT",
                "image" => "bnb.png"
            ],
            [
                "name" => "ADA/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "ADAUSDT",
                "image" => "ada.png"
            ],
            [
                "name" => "AVAX/USDT",
                "percentage" => "99%",
                "assetType" => "coin",
                "symbol" => "AVAXUSDT",
                "image" => "avax.png"
            ],
            [
                "name" => "TRX/USDT",
                "percentage" => "90%",
                "assetType" => "coin",
                "symbol" => "TRXUSDT",
                "image" => "trx.png"
            ],
            [
                "name" => "MATIC/USDT",
                "percentage" => "91%",
                "assetType" => "coin",
                "symbol" => "MATICUSDT",
                "image" => "matic.png"
            ],
            [
                "name" => "ATOM/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "ATOMUSDT",
                "image" => "atom.png"
            ],
            [
                "name" => "LINK/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "LINKUSDT",
                "image" => "link.png"
            ],
            [
                "name" => "DASH/USDT",
                "percentage" => "87%",
                "assetType" => "coin",
                "symbol" => "DASHUSDT",
                "image" => "dash.png"
            ],
            [
                "name" => "XLM/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "XLMUSDT",
                "image" => "xlm.png"
            ],
            [
                "name" => "NEO/USDT",
                "percentage" => "93%",
                "assetType" => "coin",
                "symbol" => "NEOUSDT",
                "image" => "neo.png"
            ],
            [
                "name" => "BAT/USDT",
                "percentage" => "83%",
                "assetType" => "coin",
                "symbol" => "BATUSDT",
                "image" => "bat.png"
            ],
            [
                "name" => "ETC/USDT",
                "percentage" => "86%",
                "assetType" => "coin",
                "symbol" => "ETCUSDT",
                "image" => "etc.png"
            ],
            [
                "name" => "ZEC/USDT",
                "percentage" => "94%",
                "assetType" => "coin",
                "symbol" => "ZECUSDT",
                "image" => "zec.png"
            ],
            [
                "name" => "ONT/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "ONTUSDT",
                "image" => "ont.png"
            ],
            [
                "name" => "STX/USDT",
                "percentage" => "96%",
                "assetType" => "coin",
                "symbol" => "STXUSDT",
                "image" => "stx.png"
            ],
            [
                "name" => "MKR/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "MKRUSDT",
                "image" => "mkr.png"
            ],
            [
                "name" => "AAVE/USDT",
                "percentage" => "90%",
                "assetType" => "coin",
                "symbol" => "AAVEUSDT",
                "image" => "aave.png"
            ],
            [
                "name" => "XMR/USDT",
                "percentage" => "99%",
                "assetType" => "coin",
                "symbol" => "XMRUSDT",
                "image" => "xmr.png"
            ],
            [
                "name" => "YFI/USDT",
                "percentage" => "95%",
                "assetType" => "coin",
                "symbol" => "YFIUSDT",
                "image" => "yfi.png"
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
                'image_url' => "assets/icons/" . $weekdayTradingPair[$asset]['image'],
                'type' => 'coin',
                'sentiment' => $sentiment,
            ];
        } else {
            $asset = rand(0, count($weekendTradingPair) - 1);
            return [
                'ticker_symbol' => $weekendTradingPair[$asset]['symbol'],
                'display_name' => $weekendTradingPair[$asset]['name'],
                'percentage' => $weekendTradingPair[$asset]['percentage'],
                'image_url' => "assets/icons/" . $weekendTradingPair[$asset]['image'],
                'type' => 'coin',
                'sentiment' => $sentiment,
            ];
        }
    }

    public function selectStrategy(string $strategyId): void
    {
        $filtered = $this->strategies->filter(function (Strategy $value, $key) use ($strategyId) {
            return $value['id'] === intval($strategyId);
        });

        $this->strategy = $filtered->first();
    }

    public function checkForEmptyAmountField(): bool
    {
        if ($this->amount === '') {
            $this->dispatch('robot-error', message: 'Amount field is empty')->self();
            return false;
        }
        return true;
    }

    public function checkForZeroAmountField(): bool
    {
        if ($this->amount === '0') {
            $this->dispatch('robot-error', message: 'Amount must be greater than 0')->self();
            return false;
        }
        return true;
    }

    public function isAmountUpToPlanMinimum(): bool
    {
        if ($this->amount < intval($this->strategy['min_amount'])) {
            $message = 'Minimum amount is $' . $this->strategy['min_amount'];
            $this->dispatch('robot-error', message: $message)->self();
            return false;
        }
        return true;
    }

    public function normalizeAmount(int $amount): int | float
    {
        return $amount / 100;
    }

    public function serializeAmount(float $amount): int
    {
        return $amount * 100;
    }

    public function checkAccountBalance(): bool
    {
        $accountBalanceToCheck = $this->accountTypeSlug === 'demo' ? auth()->user()->demo_balance : auth()->user()->live_balance;
        $normalizedBalance = $this->normalizeAmount($accountBalanceToCheck);

        if (floatval($this->amount) > $normalizedBalance) {
            $this->dispatch('robot-error', message: 'Insufficient balance')->self();
            return false;
        }
        return true;
    }

    public function isRobotSessionActive(): bool
    {
        $bot = Bot::where(['user_id' => auth()->user()->id, 'status' => 'active'])->get();

        if (! $bot->isEmpty()) {
            $this->dispatch('robot-error', message: 'Bot is still trading')->self();
            return false;
        }
        return true;
    }

    /**
     * Generate profit values.
     */
    function generateProfit($totalIntervals, $profitLimit)
    {
        $profitValues = [];

        for ($i = 0; $i < $totalIntervals; $i++) {
            $profitValues[] = mt_rand(0, 8000) / 1000;
        }

        $profitValuesSum = array_sum($profitValues);

        $normalizedProfitValues = [];

        foreach ($profitValues as $value) {
            $normalizedProfitValues[] = round(($value / $profitValuesSum) * $profitLimit, 2);
        }

        return $normalizedProfitValues;
    }

    public function startRobot(): void
    {
        try {
            $isAmountFieldEmpty = $this->checkForEmptyAmountField();
            $isAmountFieldZero = $this->checkForZeroAmountField();
            $isAmountUpToPlanMinimum = $this->isAmountUpToPlanMinimum();
            $isAccountBalanceSufficient = $this->checkAccountBalance();
            $isRobotSessionActive = $this->isRobotSessionActive();

            if (! $isAmountFieldEmpty || ! $isAmountFieldZero || ! $isAmountUpToPlanMinimum || ! $isAccountBalanceSufficient || ! $isRobotSessionActive) {
                return;
            }

            $amount = floatval($this->amount);
            $assetToTrade = $this->generateAssetToTrade();
            $profitLimit = (intval($this->strategy['max_roi']) / 100) * $amount;
            $balanceToDebit = $this->accountTypeSlug === 'demo' ? 'demo_balance' : 'live_balance';
            $currentBalance = $this->normalizeAmount(auth()->user()->{$balanceToDebit});
            $newBalance = $currentBalance - $amount;
            $serialized = $this->serializeAmount($newBalance);

            DB::transaction(function () use ($amount, $serialized, $profitLimit, $assetToTrade, $balanceToDebit) {
                Bot::create([
                    'user_id' => auth()->user()->id,
                    'amount' => $this->serializeAmount($amount),
                    'duration' => $this->duration,
                    'strategy' => $this->strategy['id'],
                    'account_type' => $this->accountTypeSlug,
                    'profit' => 0,
                    'profit_values' => json_encode($this->generateProfit(288, $profitLimit)),
                    'profit_position' => 0,
                    'asset' => $assetToTrade['display_name'],
                    'asset_image_url' => $assetToTrade['image_url'],
                    'sentiment' => $assetToTrade['sentiment'],
                    'status' => 'active',
                    'timer_checkpoint' => strval(now()->addMinutes(5)->addSeconds(12)->getTimestampMs()),
                    'start' => strval(now()->getTimestampMs()),
                    'end' => strval(now()->addHours(24)->getTimestampMs())
                ]);
                User::where('id', auth()->user()->id)->update([$balanceToDebit => $serialized]);
            });

            session()->flash('message', 'Robot has started trading');

            $this->redirectRoute('dashboard.robot.traderoom');
        } catch (\Exception $e) {
            $this->dispatch('robot-error', message: $e->getMessage())->self();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.robot');
    }
}
