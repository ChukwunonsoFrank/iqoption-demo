<?php

namespace App\Livewire\Admin;

use App\Models\Bot;
use App\Models\Deposit;
use App\Models\Strategy;
use App\Models\User;
use App\Notifications\BroadcastSent;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class UsersDetails extends Component
{
    use WithPagination;

    protected $queryString = ['id'];

    #[Url]
    public $id;

    public $liveBalance;

    public $activeBotCount;

    public $bonusAmount;

    public $subject;

    public $message;

    public $strategies;

    public function mount()
    {
        $this->strategies = Strategy::all();
    }

    public function getStatusIndicatorColor(string $status)
    {
        if ($status === 'active' || $status === 'approved') {
            return 'bg-success-50 text-success-600';
        }

        if ($status === 'pending') {
            return 'bg-warning-50 text-warning-600';
        }

        if ($status === 'stopped' || $status === 'expired' || $status === 'declined') {
            return 'bg-error-50 text-error-600';
        }
    }

    public function getStrategyName(int $strategyId)
    {
        $filtered = $this->strategies->filter(function (Strategy $value, $key) use ($strategyId) {
            return $value['id'] === intval($strategyId);
        });

        return $filtered->first()['name'];
    }

    public function convertTimestampToDateTime(string $timestamp): string
    {
        return Carbon::createFromTimestampMs($timestamp)->format('Y-m-d H:i:s');
    }

    public function addBonus()
    {
        try {
            $user = User::where('id', $this->id)->first();
            $userLiveBalance = $user->live_balance;
            $newBalance = $userLiveBalance + (floatval($this->bonusAmount) * 100);
            User::where('id', $this->id)->update(['live_balance' => $newBalance]);

            session()->flash('success-message', 'Bonus added successfully');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function sendBroadcast()
    {
        try {
            $user = User::with('bots')->where('id', $this->id)->first();
            $user->notify(new BroadcastSent($user->name, $this->subject, $this->message));
            session()->flash('success-message', 'Email sent successfully');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function render()
    {
        $user = User::with('bots')->where('id', $this->id)->first();
        $this->liveBalance = $user->live_balance;
        $this->activeBotCount = $user->bots->where('status', 'active')->count();
        $deposits = Deposit::with('user')->where('user_id', $user->id)->latest()->paginate(10, ['*'], 'deposits_page');
        $bots = Bot::with('user')->where('user_id', $user->id)->latest()->paginate(10, ['*'], 'bots_page');

        return view('livewire.admin.users-details', [
            'deposits' => $deposits,
            'bots' => $bots,
        ]);
    }
}
