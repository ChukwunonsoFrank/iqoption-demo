<div class="flex flex-col gap-6 py-24 px-4 md:px-56 lg:px-[35rem]">
    <x-auth-header :title="__('Log In')" :description="__('')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-4">
        <!-- Email Address -->
        <input wire:model="email" type="email"
            class="py-3 px-4 block w-full border font-medium text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
            autocomplete="email" required placeholder="Email">

        <!-- Password -->
        <input wire:model="password" type="password"
            class="py-3 px-4 block w-full border font-medium text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
            autocomplete="current-password" required placeholder="Password">

        <div class="mt-2">
            <div wire:ignore class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}" data-callback="onRecaptchaSuccess"></div>
        </div>

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full rounded-xs">{{ __('Log In') }}</flux:button>
        </div>
    </form>


    @if (Route::has('password.request'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-xs font-medium">
            <flux:link class="text-accent" :href="route('password.request')">{{ __('Forgot your password?') }}</flux:link>
        </div>
    @endif

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-xs text-zinc-700 font-medium mb-3">
            {{ __('Don\'t have an account?') }}
            <flux:link class="text-accent" :href="route('register')">{{ __('Sign Up') }}</flux:link>
        </div>
    @endif

    <div class="relative border border-gray-400 p-4 rounded-xs mb-4">
        <div class="absolute -top-2 bg-white px-2">
            <h5 class="text-zinc-700 font-bold text-xs">RISK WARNING:</h5>
        </div>
        <div>
            <p class="text-gray-400 text-xs font-medium leading-[17px]">
                All trading involves risk. Only risk capital you're prepared to lose.
            </p>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('login-error', (event) => {
            const toastMarkup = `
                <div class="flex p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-gray-700 dark:text-neutral-400">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 fixed -top-37.5 right-5 z-90 transition-all duration-300 w-80 bg-white text-sm text-gray-700 border border-gray-200 rounded-xl shadow-lg [&>.toast-close]:hidden dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript
