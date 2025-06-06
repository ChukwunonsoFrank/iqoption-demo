<?php

namespace App\Livewire\Dashboard\Partials;

use App\Models\Bot;
use Livewire\Component;

class AssetIndicator extends Component
{
    public $activeBot;

    public function mount()
    {
        $this->activeBot = Bot::where(['user_id' => auth()->user()->id, 'status' => 'active'])->first();
    }

    public function render()
    {
        return view('livewire.dashboard.partials.asset-indicator');
    }
}
