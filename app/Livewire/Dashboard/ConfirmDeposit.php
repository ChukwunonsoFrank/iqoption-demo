<?php

namespace App\Livewire\Dashboard;

use App\Models\Deposit;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.app')]

class ConfirmDeposit extends Component
{
    #[Url]
    public $amount;

    #[Url]
    public $method;

    #[Url]
    public $address;

    public function createDeposit()
    {
        try {
            Deposit::create([
                'user_id' => auth()->user()->id,
                'payment_method' => $this->method,
                'amount' => $this->serializeAmount($this->amount),
                'status' => 'pending'
            ]);

            session()->flash('message', 'Deposit successful. You will receive an email when deposit has been confirmed.');

            $this->redirectRoute('dashboard.deposithistory');
        } catch (\Exception $e) {
            $this->dispatch('deposit-error', message: $e->getMessage())->self();
        }
    }

    public function serializeAmount(float $amount): int
    {
        return $amount * 100;
    }

    public function render()
    {
        return view('livewire.dashboard.confirm-deposit');
    }
}
