<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.landing-page')]

#[Title('Home')]

class Homepage extends Component
{
    public $popularMarketData = [];

    public $cryptoMarketData = [];

    public $forexMarketData = [];

    public $stocksMarketData = [];

    public $commoditiesMarketData = [];

    public $etfMarketData = [];

    public function mount()
    {
        $this->fetchCryptoMarketData();
        $this->fetchForexMarketData();
        $this->fetchStocksMarketData();
        $this->fetchCommoditiesMarketData();
        $this->fetchETFMarketData();
    }

    public function fetchCryptoMarketData()
    {
        try {
            $cryptoAPIMarketData = Cache::remember('coincap_crypto_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://rest.coincap.io/v3/assets?ids=bitcoin,ethereum,tether,solana,tron,binance,litecoin';
                $response = $client->request('GET', $endpoint, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . env('COINCAP_API_KEY'),
                    ],
                ]);
                return $response->getBody()->getContents();
            });
            $this->transformCryptoMarketData($cryptoAPIMarketData);
        } catch (\Exception $e) {
            $this->dispatch('fetch-market-data-error', message: $e->getMessage())->self();
        }
    }

    public function fetchForexMarketData()
    {
        try {
            $usdBaseForexAPIMarketData = Cache::remember('currencyapi_usd_base_forex_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://api.currencyapi.com/v3/latest?base_currency=USD&currencies=EUR,JPY,GBP,AUD';
                $response = $client->request('GET', $endpoint, [
                    'headers' => [
                        'apikey' => env('CURRENCY_API_KEY'),
                    ],
                ]);
                return $response->getBody()->getContents();
            });
            $this->transformForexMarketData($usdBaseForexAPIMarketData, 'USD');

            $gbpBaseForexAPIMarketData = Cache::remember('currencyapi_gbp_base_forex_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://api.currencyapi.com/v3/latest?base_currency=GBP&currencies=EUR,JPY';
                $response = $client->request('GET', $endpoint, [
                    'headers' => [
                        'apikey' => env('CURRENCY_API_KEY'),
                    ],
                ]);
                return $response->getBody()->getContents();
            });
            $this->transformForexMarketData($gbpBaseForexAPIMarketData, 'GBP');
        } catch (\Exception $e) {
            $this->dispatch('fetch-market-data-error', message: $e->getMessage())->self();
        }
    }

    public function fetchStocksMarketData()
    {
        try {
            $shopifyMarketData = Cache::remember('alphavantage_shopify_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=SHOP&interval=5min&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformStocksMarketData($shopifyMarketData, 'Shopify Inc.', 'SHOP');

            $nvidiaMarketData = Cache::remember('alphavantage_nvidia_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=NVDA&interval=5min&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformStocksMarketData($nvidiaMarketData, 'Nvidia Corporation', 'NVDA');

            $teslaMarketData = Cache::remember('alphavantage_tesla_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=TSLA&interval=5min&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformStocksMarketData($teslaMarketData, 'Tesla, Inc.', 'TSLA');

            $appleMarketData = Cache::remember('alphavantage_apple_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=AAPL&interval=5min&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformStocksMarketData($appleMarketData, 'Apple Inc.', 'AAPL');

            $amazonMarketData = Cache::remember('alphavantage_amazon_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=AMZN&interval=5min&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformStocksMarketData($amazonMarketData, 'Amazon.com, Inc.', 'AMZN');

            $microsoftMarketData = Cache::remember('alphavantage_microsoft_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=MSFT&interval=5min&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformStocksMarketData($microsoftMarketData, 'Microsoft Corporation', 'MSFT');
        } catch (\Exception $e) {
            $this->dispatch('fetch-market-data-error', message: $e->getMessage())->self();
        }
    }

    public function fetchCommoditiesMarketData()
    {
        try {
            $wtiCrudeMarketData = Cache::remember('alphavantage_crude_wti_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=WTI&interval=daily&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformCommoditiesMarketData($wtiCrudeMarketData, 'WTI Crude', 'WTI');

            $brentCrudeMarketData = Cache::remember('alphavantage_crude_brent_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=BRENT&interval=daily&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformCommoditiesMarketData($brentCrudeMarketData, 'Brent Crude', 'BRENT');

            $naturalGasMarketData = Cache::remember('alphavantage_natural_gas_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=NATURAL_GAS&interval=daily&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformCommoditiesMarketData($naturalGasMarketData, 'Natural Gas', 'NG');

            $copperMarketData = Cache::remember('alphavantage_copper_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=COPPER&interval=monthly&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformCommoditiesMarketData($copperMarketData, 'Copper', 'HG');

            $aluminumMarketData = Cache::remember('alphavantage_aluminum_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=ALUMINUM&interval=monthly&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformCommoditiesMarketData($aluminumMarketData, 'Aluminum', 'ALI');
        } catch (\Exception $e) {
            $this->dispatch('fetch-market-data-error', message: $e->getMessage())->self();
        }
    }

    public function fetchETFMarketData()
    {
        try {
            $etfMarketData = Cache::remember('alphavantage_etf_market_data', now()->addHours(12), function () {
                $client = new Client();
                $endpoint = 'https://www.alphavantage.co/query?function=ETF_PROFILE&symbol=QQQ&apikey=' . env('ALPHAVANTAGE_API_KEY');
                $response = $client->request('GET', $endpoint);
                return $response->getBody()->getContents();
            });
            $this->transformETFMarketData($etfMarketData);
        } catch (\Exception $e) {
            $this->dispatch('fetch-market-data-error', message: $e->getMessage())->self();
        }
    }

    public function transformCryptoMarketData($data)
    {
        $marketData = json_decode($data);

        if ($marketData === null) {
            throw new \Exception('Invalid API data: crypto(null)');
        }

        foreach ($marketData->data as $data) {
            $dataArr = [];
            $dataArr['name'] = $data->name;
            $dataArr['symbol'] = $data->symbol;
            $dataArr['priceUsd'] = substr((string)$data->priceUsd, 0, 8);
            $dataArr['iconUrlPath'] = $this->generateAssetIconPath($dataArr['symbol']);
            $this->cryptoMarketData[] = $dataArr;

            if ($data->name === 'Bitcoin') {
                $this->popularMarketData[] = $dataArr;
            }

            if ($data->name === 'Ethereum') {
                $this->popularMarketData[] = $dataArr;
            }
        }
    }

    public function transformForexMarketData($data, $base)
    {
        $marketData = json_decode($data);

        if ($marketData === null) {
            throw new \Exception('Invalid API data: forex(null)');
        }

        if ($base === null) {
            throw new \Exception('Invalid base currency: forex');
        }

        if ($marketData && isset($marketData->data) && is_object($marketData->data)) {
            foreach ($marketData->data as $currencyCode => $currencyDetails) {
                $dataArr = [];
                $dataArr['name'] = $base . '/' . $currencyDetails->code;
                $dataArr['symbol'] = $base . $currencyDetails->code;
                $dataArr['iconUrlPath'] = $this->generateAssetIconPath($dataArr['symbol']);
                $dataArr['price'] = substr((string)$currencyDetails->value, 0, 8);
                $this->forexMarketData[] = $dataArr;
            }
        }
    }

    public function transformStocksMarketData($data, $name, $symbol)
    {
        $marketData = json_decode($data, true)['Time Series (5min)'];

        if ($marketData === null) {
            throw new \Exception('Invalid API data: stocks(null)');
        }

        if ($name === null) {
            throw new \Exception('Invalid base currency: stocks');
        }

        if ($symbol === null) {
            throw new \Exception('Invalid base currency: stocks');
        }

        $assetClosePrice = $marketData[array_key_last($marketData)]['4. close'];
        $dataArr = [];
        $dataArr['name'] = $name;
        $dataArr['symbol'] = $symbol;
        $dataArr['priceUsd'] = substr((string)$assetClosePrice, 0, 8);
        $dataArr['iconUrlPath'] = $this->generateAssetIconPath($dataArr['symbol']);
        $this->stocksMarketData[] = $dataArr;

        if ($name === 'Nvidia Corporation') {
            $this->popularMarketData[] = $dataArr;
        }

        if ($name === 'Tesla, Inc.') {
            $this->popularMarketData[] = $dataArr;
        }
    }

    public function transformCommoditiesMarketData($data, $name, $symbol)
    {
        $marketData = json_decode($data, true);

        if ($marketData === null) {
            throw new \Exception('Invalid API data: commodities(null)');
        }

        if ($name === null) {
            throw new \Exception('Invalid commodity name: commodities');
        }

        if ($symbol === null) {
            throw new \Exception('Invalid commodity symbol: commodities');
        }

        $dataArr = [];
        $dataArr['name'] = $name;
        $dataArr['symbol'] = $symbol;
        $dataArr['priceUsd'] = $marketData['data'][0]['value'];
        $dataArr['iconUrlPath'] = $this->generateAssetIconPath($dataArr['symbol']);
        $this->commoditiesMarketData[] = $dataArr;

        if ($name === 'Brent Crude') {
            $this->popularMarketData[] = $dataArr;
        }
    }

    public function transformETFMarketData($data)
    {
        $marketData = json_decode($data, true);

        if ($marketData === null) {
            throw new \Exception('Invalid API data: etfs(null)');
        }

        $dataArr = [];

        $firstFiveETFs = array_slice($marketData['holdings'], 0, 5);

        foreach ($firstFiveETFs as $etf) {
            $dataArr['name'] = $etf['description'];
            $dataArr['symbol'] = $etf['symbol'];
            $dataArr['price'] = $etf['weight'];
            $dataArr['iconUrlPath'] = $this->generateAssetIconPath($dataArr['symbol']);
            $this->etfMarketData[] = $dataArr;
        }
    }

    public function generateAssetIconPath($symbol)
    {
        /**
         * Cryptocurrency assets
         */
        if ($symbol === 'BTC') {
            return 'assets/icons/btc.svg';
        }

        if ($symbol === 'ETH') {
            return 'assets/icons/eth.svg';
        }

        if ($symbol === 'USDT') {
            return 'assets/icons/usdt.svg';
        }

        if ($symbol === 'SOL') {
            return 'assets/icons/sol.svg';
        }

        if ($symbol === 'TRX') {
            return 'assets/icons/trx.svg';
        }

        if ($symbol === 'BNB') {
            return 'assets/icons/bnb.svg';
        }

        if ($symbol === 'LTC') {
            return 'assets/icons/ltc.svg';
        }

        /**
         * Forex assets
         */
        if ($symbol === 'USDAUD') {
            return 'assets/icons/usdaud.svg';
        }

        if ($symbol === 'USDEUR') {
            return 'assets/icons/usdeur.svg';
        }

        if ($symbol === 'USDGBP') {
            return 'assets/icons/usdgbp.svg';
        }

        if ($symbol === 'USDJPY') {
            return 'assets/icons/usdjpy.svg';
        }

        if ($symbol === 'GBPEUR') {
            return 'assets/icons/gbpeur.svg';
        }

        if ($symbol === 'GBPJPY') {
            return 'assets/icons/gbpjpy.svg';
        }

        /**
         * Stocks assets
         */
        if ($symbol === 'SHOP') {
            return 'assets/icons/shop.svg';
        }

        if ($symbol === 'NVDA') {
            return 'assets/icons/nvda.svg';
        }

        if ($symbol === 'TSLA') {
            return 'assets/icons/tsla.svg';
        }

        if ($symbol === 'AAPL') {
            return 'assets/icons/aapl.svg';
        }

        if ($symbol === 'AMZN') {
            return 'assets/icons/amzn.svg';
        }

        if ($symbol === 'MSFT') {
            return 'assets/icons/msft.svg';
        }

        /**
         * Commodities and ETFs assets
         */
        if ($symbol === 'WTI' || $symbol === 'BRENT') {
            return 'assets/icons/blackbull.svg';
        }

        if ($symbol === 'NG' || $symbol === 'HG') {
            return 'assets/icons/capitalcom.svg';
        }

        if ($symbol === 'ALI' || $symbol === 'AVGO') {
            return 'assets/icons/nasdaq.svg';
        }

        return '';
    }

    public function render()
    {
        return view('livewire.homepage');
    }
}
