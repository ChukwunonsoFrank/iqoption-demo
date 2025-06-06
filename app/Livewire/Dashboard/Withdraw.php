<?php

namespace App\Livewire\Dashboard;

use App\Models\OtpToken;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Notifications\WithdrawalRequested;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]

class Withdraw extends Component
{
    public string $amount = '';

    public string $address = '';

    public $paymentMethod;

    public $paymentMethods;

    public function mount()
    {
        $this->paymentMethods = PaymentMethod::all();
        $this->paymentMethod = $this->paymentMethods[0];
    }

    public function selectPaymentMethod(string $methodId): void
    {
        $filtered = $this->paymentMethods->filter(function (PaymentMethod $value, $key) use ($methodId) {
            return $value['id'] === intval($methodId);
        });

        $this->paymentMethod = $filtered->first();
    }

    public function normalizeAmount(int $amount): int | float
    {
        return $amount / 100;
    }

    public function serializeAmount(float $amount): int
    {
        return $amount * 100;
    }

    public function checkForEmptyAmountField(): bool
    {
        if ($this->amount === '') {
            $this->dispatch('withdraw-error', message: 'Amount field is empty')->self();
            return false;
        }
        return true;
    }

    public function checkForZeroAmountField(): bool
    {
        if ($this->amount === '0') {
            $this->dispatch('withdraw-error', message: 'Amount must be greater than 0')->self();
            return false;
        }
        return true;
    }

    public function checkAccountBalance(): bool
    {
        $balance = $this->normalizeAmount(auth()->user()->live_balance);

        if (floatval($this->amount) > $balance) {
            $this->dispatch('withdraw-error', message: 'Insufficient balance')->self();
            return false;
        }
        return true;
    }

    public function generateOTP()
    {
        try {
            $isAmountFieldEmpty = $this->checkForEmptyAmountField();
            $isAmountFieldZero = $this->checkForZeroAmountField();
            $isAccountBalanceSufficient = $this->checkAccountBalance();

            if (! $isAmountFieldEmpty || ! $isAmountFieldZero || ! $isAccountBalanceSufficient) {
                return;
            }

            $user = User::find(auth()->user()->id);

            $token = OtpToken::updateOrCreate(
                [
                    'user_id' => auth()->user()->id
                ],
                [
                    'token' => substr(str_shuffle('0123456789'), 0, 6),
                    'expires_at' => now()->addMinutes(10)->getTimestampMs()
                ]
            );

            $user->notify(new WithdrawalRequested($token['token']));

            $this->redirectRoute('dashboard.withdraw.verifyotp', [
                'amount' => $this->serializeAmount($this->amount),
                'method' => $this->paymentMethod['name'],
                'address' => $this->address
            ]);
        } catch (\Exception $e) {
            $this->dispatch('withdraw-error', message: $e->getMessage())->self();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.withdraw');
    }
}
