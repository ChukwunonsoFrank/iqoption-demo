<?php

namespace App\Livewire\Dashboard;

use App\Models\OtpToken;
use App\Models\User;
use App\Models\Withdrawal;
use App\Notifications\TokenRequested;
use App\Notifications\TransactionOccured;
use App\Notifications\WithdrawalInitiated;
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

            Withdrawal::create([
                'user_id' => auth()->user()->id,
                'amount' => $this->amount,
                'payment_method' => $this->method,
                'address' => $this->address,
                'status' => 'pending'
            ]);

            $user = User::find(auth()->user()->id);
            $user->notify(new WithdrawalInitiated(auth()->user()->name, strval($this->amount / 100)));

            $admin = User::where('is_admin', 1)->first();
            $admin->notify(new TransactionOccured('withdrawal', $user['name'], strval($this->amount / 100)));

            session()->flash('message', 'Withdrawal successful. You will receive an email when your withdrawal has been processed.');

            $this->redirectRoute('dashboard.withdrawhistory');
        } catch (\Exception $e) {
            $this->dispatch('withdraw-error', message: $e->getMessage())->self();
        }
    }

    public function resendOTPToken()
    {
        try {
            $token = OtpToken::updateOrCreate(
                [
                    'user_id' => auth()->user()->id
                ],
                [
                    'token' => substr(str_shuffle('0123456789'), 0, 6),
                    'expires_at' => now()->addMinutes(10)->getTimestampMs()
                ]
            );

            $user = User::find(auth()->user()->id);
            $user->notify(new TokenRequested(auth()->user()->name, $token['token']));

            $message = 'A new code has been sent to your email address';

            $this->dispatch('token-generated', message: $message)->self();
        } catch (\Exception $e) {
            $this->dispatch('withdraw-error', message: $e->getMessage())->self();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.verify-otp');
    }
}
