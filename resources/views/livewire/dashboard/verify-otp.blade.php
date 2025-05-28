<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-80 lg:pt-6">
            <div class="mb-3 sticky top-0 bg-dashboard z-10 pb-2 lg:pt-4">
                <h1 class="text-white mb-2 text-lg md:text-xl lg:text-2xl font-semibold">Check your email</h1>
                <p class="text-zinc-300 text-xs">Enter the verification code sent to jdoe@gmail.com</p>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll">
                <div class="mb-5">
                    <input type="text"
                        class="bg-navbar text-white border border-gray-700 text-sm py-2.5 sm:py-3 px-2 ps-4 block w-full rounded-lg sm:text-sm focus:outline-0"
                        placeholder="">
                </div>

                <div class="mb-5">
                    <p class="text-[11px] text-white">Didn't receive a code? <a class="font-semibold text-accent-hover underline" href="">Resend code</a></p>
                </div>

                <div>
                    <a href="{{ route('dashboard.withdraw.verifyotp') }}">
                        <button type="button"
                            class="py-3 cursor-pointer px-4 w-full md:px-6 md:py-3 text-center gap-x-2 text-sm md:text-base font-semibold rounded-lg bg-accent text-white focus:outline-hidden">
                            Verify
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
