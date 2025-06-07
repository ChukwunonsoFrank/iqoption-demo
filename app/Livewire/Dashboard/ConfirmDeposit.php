<?php

namespace App\Livewire\Dashboard;

use App\Models\Deposit;
use App\Models\User;
use App\Notifications\DepositInitiated;
use App\Notifications\TransactionOccured;
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
                'amount' => $this->amount,
                'status' => 'pending'
            ]);

            /**
             * Send notifications to respective correspondents.
             */
            $user = User::find(auth()->user()->id);
            $user->notify(new DepositInitiated(auth()->user()->name, strval($this->amount / 100)));

            $admin = User::where('is_admin', 1)->first();
            $admin->notify(new TransactionOccured('deposit', $user['name'], strval($this->amount / 100)));

            session()->flash('message', 'Deposit successful. You will receive an email when deposit has been confirmed.');

            $this->redirectRoute('dashboard.deposithistory');
        } catch (\Exception $e) {
            $this->dispatch('deposit-error', message: $e->getMessage())->self();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.confirm-deposit');
    }
}
