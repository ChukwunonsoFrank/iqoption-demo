<?php

namespace App\Livewire\Dashboard;

use App\Models\Withdrawal;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')] 

class WithdrawHistory extends Component
{
    public $perPage = 10;

    public $visibleCount;

    public $totalWithdrawals;

    public function mount()
    {
        if (session()->has('message')) {
            $message = session()->get('message');
            $this->dispatch('withdrawal-created', message: $message)->self();
        }

        $this->totalWithdrawals = Withdrawal::where('user_id', auth()->user()->id)->count();
        $this->visibleCount = min($this->perPage, $this->totalWithdrawals);
    }

    public function loadMore(): void
    {
        $this->visibleCount = min($this->visibleCount + $this->perPage, $this->totalWithdrawals);
    }

    public function render()
    {
        $withdrawals = Withdrawal::where('user_id', auth()->user()->id)->latest()->take($this->visibleCount)->get();

        $showLoadMoreButton = $this->visibleCount < $this->totalWithdrawals;

        return view('livewire.dashboard.withdraw-history', [
            'withdrawals' => $withdrawals,
            'showLoadMoreButton' => $showLoadMoreButton,
        ]);
    }
}
