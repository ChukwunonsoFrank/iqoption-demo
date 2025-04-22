<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.landing-page')]

class Homepage extends Component
{
    public $cryptoMarketData = [];

    public $forexMarketData = [];

    public $stocksMarketData = [];

    public function mount()
    {
        $this->fetchCryptoMarketData();
        $this->fetchForexMarketData();
        $this->fetchStocksMarketData();
    }

    public function fetchCryptoMarketData()
    {
        try {
            $cryptoAPIMarketData = Cache::remember('coincap_crypto_market_data', now()->addHours(2), function () {
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
            $usdBaseForexAPIMarketData = Cache::remember('currencyapi_usd_base_forex_market_data', now()->addHours(3), function () {
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

            $gbpBaseForexAPIMarketData = Cache::remember('currencyapi_gbp_base_forex_market_data', now()->addHours(3), function () {
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

    public function transformCryptoMarketData($data)
    {
        $marketData = json_decode($data);
        foreach ($marketData->data as $data) {
            $dataArr = [];
            $dataArr['name'] = $data->name;
            $dataArr['symbol'] = $data->symbol;
            $dataArr['priceUsd'] = substr((string)$data->priceUsd, 0, 8);
            $dataArr['iconUrlPath'] = $this->generateAssetIconPath($dataArr['symbol']);
            $this->cryptoMarketData[] = $dataArr;
        }
    }

    public function transformForexMarketData($data, $base)
    {
        $marketData = json_decode($data);
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
        $assetClosePrice = $marketData[array_key_last($marketData)]['4. close'];
        $dataArr = [];
        $dataArr['name'] = $name;
        $dataArr['symbol'] = $symbol;
        $dataArr['price'] = substr((string)$assetClosePrice, 0, 8);
        $dataArr['iconUrlPath'] = $this->generateAssetIconPath($dataArr['symbol']);
        $this->stocksMarketData[] = $dataArr;
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
    }

    public function render()
    {
        return view('livewire.homepage');
    }
}
