<?php

namespace App\Livewire\Dashboard;

use App\Models\Referral;
use App\Models\User;
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
    $referrals = Referral::with('user')->where('user_id', auth()->user()->id)->latest()->take($this->visibleCount)->get();

    $referralCodes = $referrals->pluck('referral_code')->unique()->filter();
    $refereesByCode = User::whereIn('referral_code', $referralCodes)->pluck('name', 'referral_code');

    $referrals->each(function ($referral) use ($refereesByCode) {
      $referral->referee_name = $refereesByCode[$referral->referral_code] ?? 'Unknown';
    });

    $showLoadMoreButton = $this->visibleCount < $this->totalReferrals;

    return view('livewire.dashboard.show-referrals', [
      'referrals' => $referrals,
      'showLoadMoreButton' => $showLoadMoreButton,
    ]);
  }
}
