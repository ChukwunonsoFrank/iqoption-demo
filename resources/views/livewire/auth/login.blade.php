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

        <!-- Remember Me -->
        {{-- <flux:checkbox wire:model="remember" :label="__('Remember me')" /> --}}

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full rounded-xs">{{ __('Log In') }}</flux:button>
        </div>
    </form>

    @if (Route::has('password.request'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-xs font-medium">
            <flux:link class="text-accent" :href="route('password.request')" wire:navigate>{{ __('Forgot your password?') }}</flux:link>
        </div>
    @endif

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-xs text-zinc-700 font-medium mb-3">
            {{ __('Don\'t have an account?') }}
            <flux:link class="text-accent" :href="route('register')" wire:navigate>{{ __('Sign Up') }}</flux:link>
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
