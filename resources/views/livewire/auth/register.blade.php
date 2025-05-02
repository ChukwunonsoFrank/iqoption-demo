<div class="flex flex-col gap-6 py-24 px-4 md:px-56 lg:px-[35rem]">
    <x-auth-header :title="__('Sign Up')" :description="__('')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-4">
        <!-- Name -->
        <input wire:model="name" type="text" class="py-3 px-4 block w-full border font-medium text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
        autocomplete="name" required placeholder="Fullname">

        <!-- Email Address -->
        <input wire:model="email" type="email" class="py-3 px-4 block w-full border font-medium text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
        autocomplete="email" required placeholder="Email">

        <!-- Password -->
        <input wire:model="password" type="password" class="py-3 px-4 block w-full border font-medium text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
        autocomplete="new-password" required placeholder="Password">

        <!-- Confirm Password -->
        <input wire:model="password_confirmation" type="password" class="py-3 px-4 block w-full border font-medium text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
        autocomplete="new-password" required placeholder="Confirm Password">

        <div class="flex space-x-3 mb-3">
            <div class="flex-none">
                <input type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-accent checked:border-accent disabled:opacity-50 disabled:pointer-events-none" id="hs-default-checkbox">
            </div>
            <div class="flex-1">
                <p class="text-xs text-zinc-700 font-medium">I confirm that I am 18 years old or older and accept the <a class="text-accent font-semibold" href="{{ route('terms') }}">Terms & Conditions</a> and <a class="text-accent font-semibold" href="{{ route('privacy') }}">Privacy Policy</a></p>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full rounded-xs">
                {{ __('Create Account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-xs text-zinc-700 font-medium mb-3">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" class="text-accent" wire:navigate>{{ __('Log in') }}</flux:link>
        {{ __('now') }}
    </div>

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
