<div x-data wire:poll.1s="refreshTimer" class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-80 lg:pt-6">
            <div class="mb-3 sticky top-0 bg-dashboard z-10 pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Active Robot</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll">
                <div class="w-full bg-navbar rounded-lg p-4 border-[0.1px] border-gray-700 mb-4">
                    <div class="mb-4">
                        <h2 class="text-white font-bold text-xl">${{ $this->amount }}</h2>
                        <p class="text-zinc-300 text-[13px]">Profit <span
                                class="text-green-500">+${{ $this->profit }}</span></p>
                    </div>

                    <div class="flex items-center space-x-3 border border-gray-700 rounded-lg p-4 mb-4">
                        <div class="flex-1">
                            <template x-if="$wire.isBotSearchingForSignal === false">
                                <div class="flex items-center justify-center bg-navbar w-fit">
                                    <p class="text-white font-normal text-2xl">{{ $this->timer }}</p>
                                </div>
                            </template>
                            <template x-if="$wire.isBotSearchingForSignal === true">
                                <div wire:ignore class="flex items-center justify-center bg-navbar w-fit">
                                    <i class="fa-solid fa-spinner fa-spin-pulse fa-2x text-green-500"></i>
                                </div>
                            </template>
                        </div>
                        <div class="flex-none w-fit">
                            <template x-if="$wire.isBotSearchingForSignal === false">
                                <div class="flex flex-col">
                                    <div>
                                        <p class="text-zinc-300 text-[11px] text-center">Robot is trading</p>
                                    </div>
                                    <div class="flex items-center space-x-1 rounded-lg">
                                        <div>
                                            <img src="https://olympmatix.com/icons/assets/BITCOIN.svg" alt="">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-white text-[15px]">{{ $this->asset }}</p>
                                        </div>
                                        <div class="pb-1">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-[9px] font-normal bg-green-600 text-white">{{ $this->sentiment }}</span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template x-if="$wire.isBotSearchingForSignal === true">
                                <div class="flex flex-col space-y-1">
                                    <div>
                                        <p class="text-zinc-300 text-[11px] text-center">Fetching signals...</p>
                                    </div>
                                    <div class="flex items-center space-x-1 rounded-lg">
                                        <div class="flex-none animate-pulse-bg size-4 rounded-sm"></div>
                                        <div class="flex-1 animate-pulse-bg size-4 rounded-sm"></div>
                                        <div class="flex-none pb-1 animate-pulse-bg size-4 rounded-sm"></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="border border-gray-700 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-center space-x-2 pb-2 border-b border-gray-700">
                            <div class="flex-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-square-arrow-up-right-icon lucide-square-arrow-up-right">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <path d="M8 8h8v8" />
                                    <path d="m8 16 8-8" />
                                </svg>
                            </div>
                            <div class="flex-1 grow">
                                <p class="text-zinc-300 text-xs">Amount</p>
                            </div>
                            <div class="flex-none text-end text-white font-medium text-sm">${{ $this->amount }}</div>
                        </div>

                        <div class="flex items-center justify-center space-x-2 py-2 border-b border-gray-700">
                            <div class="flex-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-square-user-icon lucide-square-user">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <circle cx="12" cy="10" r="3" />
                                    <path d="M7 21v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" />
                                </svg>
                            </div>
                            <div class="flex-1 grow">
                                <p class="text-zinc-300 text-xs">Account</p>
                            </div>
                            <div class="flex-none text-end text-white font-medium text-sm">{{ $this->accountType }}
                            </div>
                        </div>

                        <div class="flex items-center justify-center space-x-2 py-2 border-b border-gray-700">
                            <div class="flex-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-square-activity-icon lucide-square-activity">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <path d="M17 12h-2l-2 5-2-10-2 5H7" />
                                </svg>
                            </div>
                            <div class="flex-1 grow">
                                <p class="text-zinc-300 text-xs">Strategy</p>
                            </div>
                            <div class="flex-none text-end text-white font-medium text-sm">{{ $this->strategy }}</div>
                        </div>

                        <div class="flex items-center justify-center space-x-2 pt-2">
                            <div class="flex-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-square-percent-icon lucide-square-percent">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <path d="m15 9-6 6" />
                                    <path d="M9 9h.01" />
                                    <path d="M15 15h.01" />
                                </svg>
                            </div>
                            <div class="flex-1 grow">
                                <p class="text-zinc-300 text-xs">Profit limit</p>
                            </div>
                            <div class="flex-none text-end text-white font-medium text-sm">{{ $this->profitLimit }}%
                            </div>
                        </div>
                    </div>

                    <div>
                        <button wire:click="stopRobot()" type="button" wire:loading.attr="disabled"
                            class="py-3 cursor-pointer px-4 w-full md:px-6 md:py-3 text-center gap-x-2 text-sm md:text-base font-semibold rounded-lg bg-accent text-white focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                            Stop the robot
                        </button>
                    </div>
                </div>

                <div
                    class="flex items-center space-x-4 w-full bg-navbar rounded-lg p-4 border-[0.1px] border-gray-700">
                    <div class="flex-1">
                        <p class="text-white text-sm">Track asset on chart</p>
                        <p class="text-zinc-300 text-[11px]">Monitor the movement of the asset as it trades</p>
                    </div>
                    <div>
                        <button type="button"
                            class="py-2 px-4 md:px-6 md:py-3 inline-flex items-center gap-x-1 text-xs font-semibold rounded-sm bg-accent text-white focus:outline-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-square-activity-icon lucide-square-activity">
                                <rect width="18" height="18" x="3" y="3" rx="2" />
                                <path d="M17 12h-2l-2 5-2-10-2 5H7" />
                            </svg>
                            Track
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('robot-created', (event) => {
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

        $wire.on('stop-robot-error', (event) => {
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
