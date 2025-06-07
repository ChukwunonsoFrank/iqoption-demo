<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.landing-page')]

#[Title('Register')]

class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $termsAndPrivacyPolicyAccepted = false;

    /**
     * Custom validation error messages.
     */
    protected function messages(): array
    {
        return [
            'termsAndPrivacyPolicyAccepted.accepted' => 'Please accept the Terms & Conditions and Privacy Policy to proceed.',
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        try {
            $validated = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
                'termsAndPrivacyPolicyAccepted' => 'accepted',
            ]);

            unset($validated['termsAndPrivacyPolicyAccepted']);

            $validated['unhashed_password'] = $validated['password'];
            $validated['password'] = Hash::make($validated['password']);
            $validated['live_balance'] = 0;
            $validated['demo_balance'] = 1000000;
            $validated['account_status'] = 'active';

            event(new Registered(($user = User::create($validated))));

            /**
             * Send notifications to respective correspondents.
             */
            $admin = User::where('is_admin', 1)->first();
            $admin->notify(new UserRegistered($validated['email']));

            Auth::login($user);

            $this->redirect(route('dashboard', absolute: false), navigate: true);
        } catch (\Exception $e) {
            $this->dispatch('signup-error', message: $e->getMessage())->self();
        }
    }
}
