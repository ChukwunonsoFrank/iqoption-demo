<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.auth.layout')]

#[Title('Register')]

class Register extends Component
{
    #[Url]
    public $ref;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $termsAndPrivacyPolicyAccepted = false;

    public $gRecaptchaResponse;

    /**
     * Custom validation error messages.
     */
    protected function messages(): array
    {
        return [
            'termsAndPrivacyPolicyAccepted.accepted' => 'Please accept the Terms & Conditions and Privacy Policy to proceed.',
        ];
    }

    public function generateReferralCode(): string
    {
        $length = 9;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return strtoupper($randomString);
    }

    /**
     * Handle an incoming registration request.
     */
    public function register()
    {
        try {
            if (is_null($this->gRecaptchaResponse)) {
                $this->dispatch('login-error', message: 'Please confirm you are not a robot.')->self();
            }

            $recatpchaResponse = Http::get("https://www.google.com/recaptcha/api/siteverify", [
                'secret' => config('services.recaptcha.secret'),
                'response' => $this->gRecaptchaResponse
            ]);

            $result = $recatpchaResponse->json();

            if ($recatpchaResponse->successful() && $result['success'] == true) {
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
                $validated['referral_code'] = $this->generateReferralCode();

                if ($this->ref) {
                    $validated['referred_by'] = $this->ref;
                }

                event(new Registered(($user = User::create($validated))));

                /**
                 * Send notifications to respective correspondents.
                 */
                $admin = User::where('is_admin', 1)->first();
                $admin->notify(new UserRegistered($validated['email']));

                Auth::login($user);

                $this->redirect(route('dashboard', absolute: false), navigate: true);
            } else {
                $this->dispatch('login-error', message: 'Please confirm you are not a robot.')->self();
                return redirect()->back();
            }
        } catch (\Exception $e) {
            $this->dispatch('signup-error', message: $e->getMessage())->self();
        }
    }
}
