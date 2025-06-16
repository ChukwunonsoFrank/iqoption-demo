<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\PaymentMethod;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]

class Deposit extends Component
{
    public string $accountStatus = '';

    public string $amount = '';

    public int $minimumDepositAmount = 100;

    public $paymentMethod;

    public $paymentMethods;

    public function mount()
    {
        $this->paymentMethods = PaymentMethod::all();
        $this->paymentMethod = $this->paymentMethods[0];
        $this->accountStatus = auth()->user()->account_status;
    }

    public function selectPaymentMethod(string $methodId): void
    {
        $filtered = $this->paymentMethods->filter(function (PaymentMethod $value, $key) use ($methodId) {
            return $value['id'] === intval($methodId);
        });

        $this->paymentMethod = $filtered->first();
    }

    public function serializeAmount(float $amount): int
    {
        return $amount * 100;
    }

    public function confirmDeposit()
    {
        if ($this->accountStatus === 'inactive') {
            $this->dispatch('deposit-error', message: 'This account has been disabled and unable to perform any transactions. Kindly contact support for more details.')->self();
            return;
        }

        if ($this->amount === '') {
            $this->dispatch('deposit-error', message: 'Amount field is empty')->self();
            return;
        }

        if (intval($this->amount) === 0) {
            $this->dispatch('deposit-error', message: 'Amount must be greater than 0')->self();
            return;
        }

        if (floatval($this->amount) < $this->minimumDepositAmount) {
            $message = 'Minimum deposit is $' . strval($this->minimumDepositAmount);
            $this->dispatch('deposit-error', message: $message)->self();
            return;
        }

        $this->redirectRoute('dashboard.deposit.confirm', [
            'amount' => $this->serializeAmount($this->amount),
            'method' => $this->paymentMethod['name'],
            'address' => $this->paymentMethod['address']
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.deposit');
    }
}
