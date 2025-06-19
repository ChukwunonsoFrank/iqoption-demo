<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Deposit;
use Livewire\Component;
use App\Models\Referral;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use App\Notifications\DepositApproved;
use App\Notifications\DepositDeclined;
use App\Notifications\CommissionEarned;

#[Layout('components.layouts.admin')]

class AdminDeposit extends Component
{
    public $firstUpline;

    public $secondUpline;

    public $thirdUpline;

    public int $level = 0;

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

    public function computeUpline(string $referredBy)
    {
        try {
            $currentUpline = User::where('referral_code', $referredBy)->first();
            if ($currentUpline !== null) {
                $this->firstUpline = $currentUpline;
                $this->level += 1;
                $currentUpline = User::where('referral_code', $currentUpline['referred_by'])->first();
                if ($currentUpline !== null) {
                    $this->secondUpline = $this->firstUpline;
                    $this->firstUpline = $currentUpline;
                    $this->level += 1;
                    $currentUpline = User::where('referral_code', $currentUpline['referred_by'])->first();
                    if ($currentUpline !== null) {
                        $this->thirdUpline = $this->secondUpline;
                        $this->secondUpline = $this->firstUpline;
                        $this->firstUpline = $currentUpline;
                        $this->level += 1;
                    }
                }
            }
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
        }
    }

    public function processReferralPayouts(float $depositAmount, string $referralCode, string $depositOwnerName)
    {
        try {
            if ($this->level === 1) {
                /**
                 * Top upline commission
                 */
                $commission = round(0.05 * floatval($depositAmount), 2);
                $newFirstUplineBalance = (($this->firstUpline['live_balance'] / 100) + $commission) * 100;

                DB::transaction(function () use ($newFirstUplineBalance, $referralCode, $commission) {
                    User::where('id', $this->firstUpline['id'])->update(['live_balance' => $newFirstUplineBalance]);
                    Referral::create([
                        'user_id' => $this->firstUpline['id'],
                        'referral_code' => $referralCode,
                        'amount' => $commission * 100,
                        'level' => '1'
                    ]);
                });

                $this->firstUpline->notify(new CommissionEarned($this->firstUpline['name'], $depositOwnerName, strval($commission)));
            }

            if ($this->level === 2) {
                /**
                 * Middle upline commission
                 */
                $commission = round(0.05 * floatval($depositAmount), 2);
                $newSecondUplineBalance = (($this->secondUpline['live_balance'] / 100) + $commission) * 100;

                DB::transaction(function () use ($newSecondUplineBalance, $referralCode, $commission) {
                    User::where('id', $this->secondUpline['id'])->update(['live_balance' => $newSecondUplineBalance]);
                    Referral::create([
                        'user_id' => $this->secondUpline['id'],
                        'referral_code' => $referralCode,
                        'amount' => $commission * 100,
                        'level' => '1'
                    ]);
                });

                $this->secondUpline->notify(new CommissionEarned($this->secondUpline['name'], $depositOwnerName, strval($commission)));

                /**
                 * First upline commission
                 */
                $commission = round(0.02 * floatval($depositAmount), 2);
                $newFirstUplineBalance = (($this->firstUpline['live_balance'] / 100) + $commission) * 100;

                DB::transaction(function () use ($newFirstUplineBalance, $referralCode, $commission) {
                    User::where('id', $this->firstUpline['id'])->update(['live_balance' => $newFirstUplineBalance]);
                    Referral::create([
                        'user_id' => $this->firstUpline['id'],
                        'referral_code' => $referralCode,
                        'amount' => $commission * 100,
                        'level' => '2'
                    ]);
                });

                $this->firstUpline->notify(new CommissionEarned($this->firstUpline['name'], $depositOwnerName, strval($commission)));
            }

            if ($this->level === 3) {
                /**
                 * Top upline commission
                 */
                $commission = round(0.01 * floatval($depositAmount), 2);
                $newFirstUplineBalance = (($this->firstUpline['live_balance'] / 100) + $commission) * 100;

                DB::transaction(function () use ($newFirstUplineBalance, $referralCode, $commission) {
                    User::where('id', $this->firstUpline['id'])->update(['live_balance' => $newFirstUplineBalance]);
                    Referral::create([
                        'user_id' => $this->firstUpline['id'],
                        'referral_code' => $referralCode,
                        'amount' => $commission * 100,
                        'level' => '3'
                    ]);
                });

                $this->firstUpline->notify(new CommissionEarned($this->firstUpline['name'], $depositOwnerName, strval($commission)));

                /**
                 * Middle upline commission
                 */
                $commission = round(0.02 * floatval($depositAmount), 2);
                $newSecondUplineBalance = (($this->secondUpline['live_balance'] / 100) + $commission) * 100;

                DB::transaction(function () use ($newSecondUplineBalance, $referralCode, $commission) {
                    User::where('id', $this->secondUpline['id'])->update(['live_balance' => $newSecondUplineBalance]);
                    Referral::create([
                        'user_id' => $this->secondUpline['id'],
                        'referral_code' => $referralCode,
                        'amount' => $commission * 100,
                        'level' => '2'
                    ]);
                });

                $this->secondUpline->notify(new CommissionEarned($this->secondUpline['name'], $depositOwnerName, strval($commission)));

                /**
                 * Last upline commission
                 */
                $commission = round(0.05 * floatval($depositAmount), 2);
                $newThirdUplineBalance = (($this->thirdUpline['live_balance'] / 100) + $commission) * 100;

                DB::transaction(function () use ($newThirdUplineBalance, $referralCode, $commission) {
                    User::where('id', $this->thirdUpline['id'])->update(['live_balance' => $newThirdUplineBalance]);
                    Referral::create([
                        'user_id' => $this->thirdUpline['id'],
                        'referral_code' => $referralCode,
                        'amount' => $commission * 100,
                        'level' => '1'
                    ]);
                });

                $this->thirdUpline->notify(new CommissionEarned($this->thirdUpline['name'], $depositOwnerName, strval($commission)));
            }
        } catch (\Exception $e) {
            session()->flash('error-message', $e->getMessage());
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

            $this->computeUpline($user->referred_by);

            $this->processReferralPayouts($amount / 100, $user->referral_code, $user->name);

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
        $deposits = Deposit::with('user')->whereHas('user', function ($query) {
            $query->where('is_admin', 0);
        })->latest()->paginate(10);
        return view('livewire.admin.admin-deposit', [
            'deposits' => $deposits
        ]);
    }
}
