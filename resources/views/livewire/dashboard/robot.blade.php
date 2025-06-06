<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-80 lg:pt-6">
            <div class="mb-3 sticky top-0 bg-dashboard z-10 pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Robot Settings</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll">
                <div class="mb-4">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Amount</label>
                    <div class="relative">
                        <input wire:model="amount" type="text"
                            class="bg-navbar text-white border border-gray-700 text-sm peer py-2.5 sm:py-3 px-4 ps-11 block w-full rounded-lg sm:text-sm focus:outline-0"
                            placeholder="">
                        <div
                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                            <p class="text-white text-sm font-semibold">$</p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Account</label>
                    <div class="flex-1 md:flex-none relative">
                        <div x-on:click="$store.robotPage.toggleTradingAccountSelect()"
                            class="flex items-center space-x-3 py-2.5 sm:py-3 px-4 border border-gray-700 bg-navbar rounded-lg text-[#FFFFFF]">
                            <div class="flex-1">
                                <p x-text="$wire.accountType" class="text-sm"></p>
                            </div>
                            <div class="flex-none justify-self-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chevron-down-icon lucide-chevron-down">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div x-cloak x-show="$store.robotPage.isTradingAccountSelectOpen"
                            @click.outside="$store.robotPage.isTradingAccountSelectOpen = false"
                            class="border-gray-700 bg-navbar absolute border rounded-lg w-full overflow-scroll z-10 p-2 mt-1">
                            <div wire:click="selectAccountType('Demo account', 'demo')"
                                x-on:click="$store.robotPage.isTradingAccountSelectOpen = false"
                                class="hover:bg-gray-600 cursor-pointer flex items-center space-x-3 px-4 py-2 rounded-md text-[#FFFFFF]">
                                <div class="flex-1">
                                    <p class="text-sm">Demo Account - <span class="font-bold text-xs">@money(auth()->user()->demo_balance / 100)</span></p>
                                </div>
                            </div>
                            <div wire:click="selectAccountType('Live account', 'live')"
                                x-on:click="$store.robotPage.isTradingAccountSelectOpen = false"
                                class="hover:bg-gray-600 cursor-pointer flex items-center space-x-3 px-4 py-2 rounded-md text-[#FFFFFF]">
                                <div class="flex-1">
                                    <p class="text-sm">Live Account - <span class="font-bold text-xs">@money(auth()->user()->live_balance / 100)</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 flex items-center space-x-2">
                    <div class="flex-1">
                        <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Duration</label>
                        <input type="email" value="24 hours"
                            class="bg-navbar text-white text-start border border-gray-700 text-sm py-2.5 sm:py-3 px-4 block w-full rounded-lg sm:text-sm focus:outline-0"
                            placeholder="" readonly>
                    </div>
                    <div class="flex-1">
                        <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Exchange</label>
                        <div
                            class="w-full text-sm self-center text-center border border-gray-700 py-2.5 sm:py-3 px-4 bg-navbar rounded-md text-[#FFFFFF] focus:outline-0">
                            <img class="inline" src="{{ asset('assets/icons/binance-logo.svg') }}" alt="binance-logo">
                        </div>
                    </div>
                    <div class="flex-1">
                        <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Broker</label>
                        <div
                            class="w-full text-sm self-center text-center border border-gray-700 py-2.5 sm:py-3 px-4 bg-navbar rounded-md text-[#FFFFFF] focus:outline-0">
                            <img class="inline" src="{{ asset('assets/icons/fxpro.svg') }}" alt="fxpro-logo">
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Strategy</label>
                    <div class="flex-1 md:flex-none relative">
                        <div x-on:click="$store.robotPage.toggleStrategyListOverlay()"
                            class="flex items-start space-x-2 border border-gray-700 px-4 py-4 bg-navbar rounded-md text-[#FFFFFF] cursor-pointer">
                            <div class="flex-none w-12">
                                <img class="w-24" src="{{ $this->strategy['image_url'] }}" alt="">
                            </div>
                            <div class="flex-1">
                                <h2 class="font-bold mb-1">
                                    {{ $this->strategy['name'] }}
                                </h2>
                                <p class="text-[10px] text-zinc-300 mb-1">
                                    <svg class="inline" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chart-candlestick-icon lucide-chart-candlestick">
                                        <path d="M9 5v4" />
                                        <rect width="4" height="6" x="7" y="9" rx="1" />
                                        <path d="M9 15v2" />
                                        <path d="M17 3v2" />
                                        <rect width="4" height="8" x="15" y="5" rx="1" />
                                        <path d="M17 13v3" />
                                        <path d="M3 3v16a2 2 0 0 0 2 2h16" />
                                    </svg> Profit Range:
                                    <span>{{ $this->strategy['min_roi'] }}</span>%
                                    to <span>{{ $this->strategy['max_roi'] }}</span>%
                                    in <span>{{ $this->strategy['duration'] }}</span>hrs
                                </p>
                                <p class="text-[10px] text-zinc-300">
                                    <svg class="inline" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-circle-dollar-sign-icon lucide-circle-dollar-sign">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                                        <path d="M12 18V6" />
                                    </svg> Minimum Amount: At
                                    least $<span>{{ $this->strategy['min_amount'] }}</span>
                                </p>
                            </div>
                            <div class="flex-none w-4 justify-self-end">
                                <svg class="inline" xmlns="http://www.w3.org/2000/svg" width="14" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chevron-down-icon lucide-chevron-down">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-cloak x-show="$store.robotPage.isStrategyListOverlayOpen"
                    class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard">
                    <div class="flex items-center mb-6">
                        <div class="flex-1">
                            <h2 class="text-white font-semibold md:text-xl lg:text-2xl">Strategy</h2>
                        </div>
                        <div class="flex-1 text-end">
                            <svg x-on:click="$store.robotPage.toggleStrategyListOverlay()"
                                class="inline cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        @foreach ($this->strategies as $strategy)
                            <div wire:key="strategy-{{ $strategy['id'] }}" wire:click="selectStrategy({{ $strategy['id'] }})" x-on:click="$store.robotPage.isStrategyListOverlayOpen = false"
                                class="flex items-start space-x-2 border border-gray-700 mb-3 px-4 py-4 bg-navbar rounded-md text-[#FFFFFF] cursor-pointer">
                                <div class="flex-none w-12">
                                    <img class="w-24" src="{{ $strategy['image_url'] }}"
                                        alt="">
                                </div>
                                <div class="flex-1">
                                    <h2 class="font-bold mb-1">
                                        {{ $strategy['name'] }}
                                    </h2>
                                    <p class="text-[10px] text-zinc-300 mb-1">
                                        <svg class="inline" xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-chart-candlestick-icon lucide-chart-candlestick">
                                            <path d="M9 5v4" />
                                            <rect width="4" height="6" x="7" y="9" rx="1" />
                                            <path d="M9 15v2" />
                                            <path d="M17 3v2" />
                                            <rect width="4" height="8" x="15" y="5" rx="1" />
                                            <path d="M17 13v3" />
                                            <path d="M3 3v16a2 2 0 0 0 2 2h16" />
                                        </svg> Profit Range:
                                        <span>{{ $strategy['min_roi'] }}</span>%
                                        to <span>{{ $strategy['max_roi'] }}</span>%
                                        in <span>{{ $strategy['duration'] }}</span>hrs
                                    </p>
                                    <p class="text-[10px] text-zinc-300">
                                        <svg class="inline" xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-circle-dollar-sign-icon lucide-circle-dollar-sign">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                                            <path d="M12 18V6" />
                                        </svg> Minimum Amount: At
                                        least $<span>{{ $strategy['min_amount'] }}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <a wire:click="startRobot()">
                        <button type="button" wire:loading.attr="disabled"
                            class="py-3 cursor-pointer px-4 w-full md:px-6 md:py-3 text-center gap-x-2 text-sm md:text-base font-semibold rounded-sm bg-accent text-white focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                            <i wire:loading class="fa-solid fa-circle-notch fa-spin"></i>
                            <span wire:loading.remove>Start robot</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('robotPage', {
            isStrategyListOverlayOpen: false,

            isTradingAccountSelectOpen: false,

            toggleStrategyListOverlay() {
                this.isStrategyListOverlayOpen = !this.isStrategyListOverlayOpen
            },

            toggleTradingAccountSelect() {
                this.isTradingAccountSelectOpen = !this.isTradingAccountSelectOpen
            }
        })
    })
</script>

@script
    <script>
        $wire.on('robot-error', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 border border-gray-700 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-navbar text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });

        $wire.on('zero-amount-robot-error', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 border border-gray-700 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-navbar text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });

        $wire.on('robot-stopped', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 border border-gray-700 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-navbar text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript
