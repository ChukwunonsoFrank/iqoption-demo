<?php

namespace App\Livewire\Dashboard;

use App\Models\Deposit;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')] 

class DepositHistory extends Component
{
    public $perPage = 10;

    public $visibleCount;

    public $totalDeposits;

    public function mount()
    {
        if (session()->has('message')) {
            $message = session()->get('message');
            $this->dispatch('deposit-created', message: $message)->self();
        }

        $this->totalDeposits = Deposit::where('user_id', auth()->user()->id)->count();
        $this->visibleCount = min($this->perPage, $this->totalDeposits);
    }

    public function loadMore(): void
    {
        $this->visibleCount = min($this->visibleCount + $this->perPage, $this->totalDeposits);
    }

    public function render()
    {
        $deposits = Deposit::where('user_id', auth()->user()->id)->latest()->take($this->visibleCount)->get();

        $showLoadMoreButton = $this->visibleCount < $this->totalDeposits;

        return view('livewire.dashboard.deposit-history', [
            'deposits' => $deposits,
            'showLoadMoreButton' => $showLoadMoreButton,
        ]);
    }
}
