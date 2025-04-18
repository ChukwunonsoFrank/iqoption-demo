<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.landing-page')]

class Homepage extends Component
{
    public $marketData = [];

    public function mount()
    {
        $this->fetchAssetsMarketData();
    }

    public function fetchAssetsMarketData()
    {
        try {
            $client = new Client();
            $endpoint = 'https://rest.coincap.io/v3/assets?ids=bitcoin,ethereum,tether,solana,tron,binance,litecoin';
            $response = $client->request('GET', $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('COINCAP_API_KEY'),
                ],
            ]);
            $this->transformMarketData($response->getBody()->getContents());
        } catch (\Exception $e) {
            $this->dispatch('fetch-market-data-error', message: $e->getMessage())->self();
        }
    }

    public function transformMarketData($data)
    {
        $marketData = json_decode($data);
        foreach($marketData->data as $data) {
            $dataArr = [];
            $dataArr['name'] = $data->name;
            $dataArr['symbol'] = $data->symbol;
            $dataArr['priceUsd'] = number_format($data->priceUsd, 2);
            
            if ($data->symbol === 'BTC') {
                $dataArr['iconUrlPath'] = 'assets/icons/btc.svg';
            }
            
            if ($data->symbol === 'ETH') {
                $dataArr['iconUrlPath'] = 'assets/icons/eth.svg';
            }
            
            if ($data->symbol === 'USDT') {
                $dataArr['iconUrlPath'] = 'assets/icons/usdt.svg';
            }
            
            if ($data->symbol === 'SOL') {
                $dataArr['iconUrlPath'] = 'assets/icons/sol.svg';
            }
            
            if ($data->symbol === 'TRX') {
                $dataArr['iconUrlPath'] = 'assets/icons/trx.svg';
            }
            
            if ($data->symbol === 'BNB') {
                $dataArr['iconUrlPath'] = 'assets/icons/bnb.svg';
            }
            
            if ($data->symbol === 'LTC') {
                $dataArr['iconUrlPath'] = 'assets/icons/ltc.svg';
            }

            $this->marketData[] = $dataArr;
        }
    }

    public function render()
    {
        return view('livewire.homepage');
    }
}
