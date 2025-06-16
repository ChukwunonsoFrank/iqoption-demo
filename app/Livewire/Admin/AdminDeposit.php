<?php

namespace App\Livewire\Admin;

use App\Models\Deposit;
use App\Models\User;
use App\Notifications\DepositApproved;
use App\Notifications\DepositDeclined;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class AdminDeposit extends Component
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

    public function approveDeposit(int $depositId, int $userId, int $amount)
    {
        try {
            $user = User::where('id', $userId)->first();
            $userLiveBalance = $user->live_balance;
            $newBalance = $userLiveBalance + $amount;

            DB::transaction(function () use ($depositId, $userId, $newBalance) {
                User::where('id', $userId)->update(['live_balance' => $newBalance]);
                Deposit::where('id', $depositId)->update(['status' => 'approved']);
            });

            $user->notify(new DepositApproved($user->name, strval($amount / 100)));

            session()->flash('success-message', 'Deposit approved successfully');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function declineDeposit(int $depositId, int $userId, int $amount)
    {
        try {
            $user = User::where('id', $userId)->first();

            Deposit::where('id', $depositId)->update(['status' => 'declined']);

            $user->notify(new DepositDeclined($user->name, strval($amount / 100)));

            session()->flash('success-message', 'Deposit declined successfully');
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function render()
    {
        $deposits = Deposit::with('user')->whereHas('user', function($query) {
            $query->where('is_admin', 0);
        })->latest()->paginate(10);
        return view('livewire.admin.admin-deposit', [
            'deposits' => $deposits
        ]);
    }
}
