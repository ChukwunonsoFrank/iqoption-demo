<?php

namespace App\Livewire\Dashboard;

use App\Models\Trade;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]

class History extends Component
{
    public $perPage = 10;

    public $visibleCount;

    public $totalTrades;

    public function mount()
    {
        $this->totalTrades = Trade::where('user_id', auth()->user()->id)->count();
        $this->visibleCount = min($this->perPage, $this->totalTrades);
    }

    public function loadMore(): void
    {
        $this->visibleCount = min($this->visibleCount + $this->perPage, $this->totalTrades);
    }

    public function render()
    {
        $trades = Trade::where('user_id', auth()->user()->id)->latest()->take($this->visibleCount)->get();

        $showLoadMoreButton = $this->visibleCount < $this->totalTrades;

        return view('livewire.dashboard.history', [
            'trades' => $trades,
            'showLoadMoreButton' => $showLoadMoreButton,
        ]);
    }
}
