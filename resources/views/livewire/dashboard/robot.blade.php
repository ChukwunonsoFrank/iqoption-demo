<div x-data="robotPageComponent" class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-80 lg:pt-6">
            <div class="mb-3 sticky top-0 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Robot Settings</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll">
                <div class="mb-4">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Amount</label>
                    <div class="relative">
                        <input type="email"
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
                    <select
                        class="bg-navbar text-white border border-gray-700 text-sm py-3 px-4 pe-9 block w-full rounded-lg focus:outline-0">
                        <option>Demo account</option>
                        <option>Real account</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Duration</label>
                    <select
                        class="bg-navbar text-white border border-gray-700 text-sm py-3 px-4 pe-9 block w-full rounded-lg focus:outline-0">
                        <option>5 mins</option>
                        <option>10 min</option>
                        <option>15 min</option>
                    </select>
                </div>

                <div class="mb-5">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Strategy</label>
                    <div class="flex-1 md:flex-none relative">
                        <div x-on:click="toggleStrategyListOverlay()"
                            class="flex items-start space-x-2 border border-gray-700 px-4 py-4 bg-navbar rounded-md text-[#FFFFFF] cursor-pointer">
                            <div class="flex-none w-12">
                                <img class="w-24" src="https://olympmatix.com/icons/assets/BITCOIN.svg"
                                    alt="">
                            </div>
                            <div class="flex-1">
                                <h2 class="font-bold mb-1">
                                    Node
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
                                    <span>6</span>%
                                    to <span>20</span>%
                                    in <span>24</span>hrs
                                </p>
                                <p class="text-[10px] text-zinc-300">
                                    <svg class="inline" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-circle-dollar-sign-icon lucide-circle-dollar-sign">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                                        <path d="M12 18V6" />
                                    </svg> Minimum Amount: At
                                    least $<span>100</span>
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

                <div>
                    <a href="{{ route('dashboard.robot.traderoom') }}" wire:navigate>
                        <button type="button"
                            class="py-3 cursor-pointer px-4 w-full md:px-6 md:py-3 text-center gap-x-2 text-sm md:text-base font-semibold rounded-sm bg-accent text-white focus:outline-hidden">
                            Start robot
                        </button>
                    </a>
                </div>

                <div x-cloak x-show="isStrategyListOverlayOpen"
                    class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 bg-dashboard">
                    <div class="flex items-center mb-6">
                        <div class="flex-1">
                            <h2 class="text-white font-semibold md:text-xl lg:text-2xl">Strategy</h2>
                        </div>
                        <div class="flex-1 text-end">
                            <svg x-on:click="toggleStrategyListOverlay()" class="inline cursor-pointer"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        <div
                            class="flex items-start space-x-2 border border-gray-700 mb-3 px-4 py-4 bg-navbar rounded-md text-[#FFFFFF] cursor-pointer">
                            <div class="flex-none w-12">
                                <img class="w-24" src="https://olympmatix.com/icons/assets/BITCOIN.svg"
                                    alt="">
                            </div>
                            <div class="flex-1">
                                <h2 class="font-bold mb-1">
                                    Node
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
                                    <span>6</span>%
                                    to <span>20</span>%
                                    in <span>24</span>hrs
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
                                    least $<span>100</span>
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-start space-x-2 border border-gray-700 mb-3 px-4 py-4 bg-navbar rounded-md text-[#FFFFFF] cursor-pointer">
                            <div class="flex-none w-12">
                                <img class="w-24" src="https://olympmatix.com/icons/assets/BITCOIN.svg"
                                    alt="">
                            </div>
                            <div class="flex-1">
                                <h2 class="font-bold mb-1">
                                    Node
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
                                    <span>6</span>%
                                    to <span>20</span>%
                                    in <span>24</span>hrs
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
                                    least $<span>100</span>
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-start space-x-2 border border-gray-700 mb-3 px-4 py-4 bg-navbar rounded-md text-[#FFFFFF] cursor-pointer">
                            <div class="flex-none w-12">
                                <img class="w-24" src="https://olympmatix.com/icons/assets/BITCOIN.svg"
                                    alt="">
                            </div>
                            <div class="flex-1">
                                <h2 class="font-bold mb-1">
                                    Node
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
                                    <span>6</span>%
                                    to <span>20</span>%
                                    in <span>24</span>hrs
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
                                    least $<span>100</span>
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-start space-x-2 border border-gray-700 px-4 py-4 bg-navbar rounded-md text-[#FFFFFF] cursor-pointer">
                            <div class="flex-none w-12">
                                <img class="w-24" src="https://olympmatix.com/icons/assets/BITCOIN.svg"
                                    alt="">
                            </div>
                            <div class="flex-1">
                                <h2 class="font-bold mb-1">
                                    Node
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
                                    <span>6</span>%
                                    to <span>20</span>%
                                    in <span>24</span>hrs
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
                                    least $<span>100</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('robotPageComponent', () => ({
            isStrategyListOverlayOpen: false,

            toggleStrategyListOverlay() {
                this.isStrategyListOverlayOpen = !this.isStrategyListOverlayOpen
            }
        }))
    })
</script>
