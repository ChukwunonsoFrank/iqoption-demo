<?php

namespace App\Livewire\Dashboard;

use App\Models\OtpToken;
use App\Models\User;
use App\Models\Withdrawal;
use App\Notifications\TokenRequested;
use App\Notifications\TransactionOccured;
use App\Notifications\WithdrawalInitiated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.app')]

class VerifyOtp extends Component
{
  #[Url]
  public $amount;

  #[Url]
  public $method;

  #[Url]
  public $address;

  public $token = '';

  public $generatedToken;

  public function mount()
  {
    $this->generatedToken = OtpToken::where('user_id', auth()->user()->id)->first();
  }

  public function createWithdrawal()
  {
    try {
      // Validation checks
      if ($this->token === '') {
        $this->dispatch('withdraw-error', message: 'OTP token field is empty')->self();
        return;
      }

      if ($this->token !== $this->generatedToken['token']) {
        $message = 'Invalid OTP token';
        $this->dispatch('withdraw-error', message: $message)->self();
        return;
      }

      $expiresAt = $this->generatedToken['expires_at'];
      $now = now()->getTimestampMs();
      if ($now > $expiresAt) {
        $message = 'Expired OTP token. Click on "Resend code" to generate a new token.';
        $this->dispatch('withdraw-error', message: $message)->self();
        return;
      }

      // Atomic transaction for all related operations
      DB::transaction(function () {
        // Create withdrawal record
        $withdrawal = Withdrawal::create([
          'user_id' => auth()->user()->id,
          'amount' => $this->amount,
          'payment_method' => $this->method,
          'address' => $this->address,
          'status' => 'pending'
        ]);

        // Delete the used OTP token to prevent reuse
        OtpToken::where('user_id', auth()->user()->id)->delete();

        // Fetch fresh user data within transaction
        $user = User::lockForUpdate()->find(auth()->user()->id);
        $user->notify(new WithdrawalInitiated($user->name, strval($this->amount / 100)));

        // Fetch and notify admin
        $admin = User::lockForUpdate()->where('is_admin', 1)->first();
        if ($admin) {
          $admin->notify(new TransactionOccured('withdrawal', $user->name, strval($this->amount / 100)));
        }
      });

      session()->flash('message', 'Withdrawal successful. You will receive an email when your withdrawal has been processed.');
      $this->redirectRoute('dashboard.withdrawhistory');
    } catch (\Illuminate\Database\QueryException $e) {
      Log::error('Database error in withdrawal creation', [
        'user_id' => auth()->user()->id,
        'error' => $e->getMessage()
      ]);
      $this->dispatch('withdraw-error', message: 'Database error occurred. Please try again.')->self();
    } catch (\Exception $e) {
      Log::error('Error in withdrawal creation', [
        'user_id' => auth()->user()->id,
        'error' => $e->getMessage()
      ]);
      $this->dispatch('withdraw-error', message: $e->getMessage())->self();
    }
  }

  public function resendOTPToken()
  {
    try {
      // Atomic transaction for OTP token generation
      DB::transaction(function () {
        $token = OtpToken::updateOrCreate(
          [
            'user_id' => auth()->user()->id
          ],
          [
            'token' => substr(str_shuffle('0123456789'), 0, 6),
            'expires_at' => now()->addMinutes(10)->getTimestampMs()
          ]
        );

        $user = User::lockForUpdate()->find(auth()->user()->id);
        $user->notify(new TokenRequested($user->name, $token['token']));
      }, attempts: 3);

      $message = 'A new code has been sent to your email address';
      $this->dispatch('token-generated', message: $message)->self();
    } catch (\Illuminate\Database\QueryException $e) {
      Log::error('Database error in OTP token resend', [
        'user_id' => auth()->user()->id,
        'error' => $e->getMessage()
      ]);
      $this->dispatch('withdraw-error', message: 'Failed to resend code. Please try again.')->self();
    } catch (\Exception $e) {
      Log::error('Error in OTP token resend', [
        'user_id' => auth()->user()->id,
        'error' => $e->getMessage()
      ]);
      $this->dispatch('withdraw-error', message: $e->getMessage())->self();
    }
  }

  public function render()
  {
    return view('livewire.dashboard.verify-otp');
  }
}
