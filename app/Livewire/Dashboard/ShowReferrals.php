<?php

namespace App\Livewire\Dashboard;

use App\Models\Referral;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]

class ShowReferrals extends Component
{
    public $perPage = 10;

    public $visibleCount;

    public $totalReferrals;

    public $totalCommissions;

    public function mount()
    {
        $this->totalReferrals = Referral::where('user_id', auth()->user()->id)->count();
        $this->visibleCount = min($this->perPage, $this->totalReferrals);
        $this->totalCommissions = Referral::where('user_id', auth()->user()->id)->sum('amount');
        $this->totalCommissions = $this->totalCommissions / 100;
    }

    public function loadMore(): void
    {
        $this->visibleCount = min($this->visibleCount + $this->perPage, $this->totalReferrals);
    }

    public function getLevelPercentage(string $level)
    {
        if ($level === '1') {
            return '5%';
        }

        if ($level === '2') {
            return '2%';
        }

        if ($level === '3') {
            return '1%';
        }
    }

    public function render()
    {
        $referrals = Referral::where('user_id', auth()->user()->id)->latest()->take($this->visibleCount)->get();

        $showLoadMoreButton = $this->visibleCount < $this->totalReferrals;

        return view('livewire.dashboard.show-referrals', [
            'referrals' => $referrals,
            'showLoadMoreButton' => $showLoadMoreButton,
        ]);
    }
}
