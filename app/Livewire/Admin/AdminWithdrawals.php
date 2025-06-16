<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Withdrawal;
use App\Notifications\WithdrawalApproved;
use App\Notifications\WithdrawalDeclined;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class AdminWithdrawals extends Component
{
    public function getStatusIndicatorColor(string $status)
    {
        if ($status === 'pending') {
            return 'bg-warning-50 text-warning-600';
        }

        if ($status === 'approved') {
            return 'bg-success-50 text-success-600';
        }

        if ($status === 'declined') {
            return 'bg-error-50 text-error-600';
        }
    }

    public function approveWithdrawal(int $withdrawalId, int $userId, int $amount)
    {
        try {
            $user = User::where('id', $userId)->first();
            $userLiveBalance = $user->live_balance;
            $newBalance = $userLiveBalance - $amount;

            DB::transaction(function () use ($withdrawalId, $userId, $newBalance) {
                User::where('id', $userId)->update(['live_balance' => $newBalance]);
                Withdrawal::where('id', $withdrawalId)->update(['status' => 'approved']);
            });

            $user->notify(new WithdrawalApproved($user->name, strval($amount / 100)));

            session()->flash('success-message', 'Withdrawal approved successfully');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function declineWithdrawal(int $withdrawalId, int $userId, int $amount)
    {
        try {
            $user = User::where('id', $userId)->first();

            Withdrawal::where('id', $withdrawalId)->update(['status' => 'declined']);

            $user->notify(new WithdrawalDeclined($user->name, strval($amount / 100)));

            session()->flash('success-message', 'Withdrawal declined successfully');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function render()
    {
        $withdrawals = Withdrawal::with('user')->whereHas('user', function($query) {
            $query->where('is_admin', 0);
        })->latest()->paginate(10);
        return view('livewire.admin.admin-withdrawals', [
            'withdrawals' => $withdrawals
        ]);
    }
}
