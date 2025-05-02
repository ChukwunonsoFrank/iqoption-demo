 <div class="flex flex-col gap-6 py-24 px-4 md:px-56 lg:px-[35rem]">
     <x-auth-header :title="__('Forgot Password')" :description="__('Enter your email to receive a password reset link')" />

     <!-- Session Status -->
     <x-auth-session-status class="text-center" :status="session('status')" />

     <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
         <!-- Email Address -->
         <input wire:model="email" type="email"
             class="py-3 px-4 block w-full border font-medium text-gray-600 border-gray-200 rounded-sm text-sm disabled:opacity-50 disabled:pointer-events-none"
             required placeholder="Email">

         <flux:button variant="primary" type="submit" class="w-full rounded-xs">{{ __('Email Password Reset Link') }}
         </flux:button>
     </form>

     <div class="space-x-1 rtl:space-x-reverse text-center text-xs text-zinc-700 font-medium">
         {{ __('Or, return to') }}
         <flux:link class="text-accent" :href="route('login')" wire:navigate>{{ __('log in') }}</flux:link>
     </div>
 </div>
