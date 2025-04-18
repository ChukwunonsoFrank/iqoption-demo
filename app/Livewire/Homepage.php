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
            $endpoint = 'https://rest.coincap.io/v3/assets?ids=bitcoin,ethereum';
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
                $dataArr['iconUrlPath'] = 'https://olympmatix.com/icons/assets/BITCOIN.svg';
            }
            
            if ($data->symbol === 'ETH') {
                $dataArr['iconUrlPath'] = 'https://olympmatix.com/icons/assets/ETHUSD.svg';
            }

            $this->marketData[] = $dataArr;
        }
    }

    public function render()
    {
        return view('livewire.homepage');
    }
}
