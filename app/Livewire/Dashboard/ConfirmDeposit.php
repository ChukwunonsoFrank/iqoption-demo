<?php

namespace App\Livewire\Dashboard;

use App\Models\Deposit;
use App\Models\User;
use App\Notifications\DepositInitiated;
use App\Notifications\TransactionOccured;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Throwable;

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
      DB::transaction(function () {
        // Create deposit record with user_id validation
        $deposit = Deposit::create([
          'user_id' => auth()->user()->id,
          'payment_method' => $this->method,
          'amount' => $this->amount,
          'status' => 'pending'
        ]);

        if (!$deposit->exists) {
          throw new \Exception('Failed to create deposit record.');
        }

        /**
         * Send notifications to respective correspondents.
         * Using fresh queries to ensure we have the latest data within the transaction.
         */
        $user = User::lockForUpdate()->find(auth()->user()->id);
        if (!$user) {
          throw new \Exception('User not found.');
        }

        $user->notify(new DepositInitiated($user->name, strval($this->amount / 100)));

        $admin = User::lockForUpdate()->where('is_admin', 1)->first();
        if (!$admin) {
          throw new \Exception('Admin user not found.');
        }

        $admin->notify(new TransactionOccured('deposit', $user->name, strval($this->amount / 100)));

        session()->flash('message', 'Deposit successful. You will receive an email when deposit has been confirmed.');
      });

      $this->redirectRoute('dashboard.deposithistory');
    } catch (Throwable $e) {
      $this->dispatch('deposit-error', message: $e->getMessage())->self();
    }
  }

  public function render()
  {
    return view('livewire.dashboard.confirm-deposit');
  }
}
