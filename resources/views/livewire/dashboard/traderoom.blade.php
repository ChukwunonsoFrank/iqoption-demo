<div x-data="traderoom" class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-80 lg:pt-6">
            <div class="mb-3 sticky top-0 bg-dashboard z-10 pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Active Robot</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="w-full bg-navbar rounded-lg p-4 border-[0.1px] border-gray-700 mb-4">
                    <div class="mb-4">
                        <h2 class="text-white font-bold text-xl">@money($this->amount)</h2>
                        <p class="text-zinc-300 text-[13px]">Profit <span
                                class="text-green-500">+@money($this->profit)</span></p>
                    </div>

                    <div class="flex items-center space-x-3 border border-gray-700 rounded-lg p-4 mb-4">
                        <div class="flex-1">
                            <template x-if="isBotSearchingForSignal === false">
                                <div class="flex items-center justify-center bg-navbar w-fit">
                                    <p x-text='timer' class="text-white font-normal text-2xl"></p>
                                </div>
                            </template>
                            <template x-if="isBotSearchingForSignal === true">
                                <div wire:ignore class="flex items-center justify-center bg-navbar w-fit">
                                    <i class="fa-solid fa-spinner fa-spin-pulse fa-2x text-green-500"></i>
                                </div>
                            </template>
                        </div>
                        <div class="flex-none w-fit">
                            <template x-if="isBotSearchingForSignal === false">
                                <div class="flex flex-col">
                                    <div>
                                        <p class="text-zinc-300 text-[11px] text-center">Robot is trading</p>
                                    </div>
                                    <div class="flex items-center space-x-1 rounded-lg">
                                        <div>
                                            <img x-bind:src="assetIcon" alt="">
                                        </div>
                                        <div>
                                            <p x-text="asset" class="font-semibold text-white text-[15px]"></p>
                                        </div>
                                        <div class="pb-1">
                                            <span x-text="sentiment"
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-[9px] font-normal text-white" x-bind:class="sentiment === 'BUY' ? 'bg-green-600' : 'bg-red-600'"></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template x-if="isBotSearchingForSignal === true">
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
                            <div class="flex-none text-end text-white font-medium text-sm">@money($this->amount)</div>
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
                        <button x-on:click="toggleStopRobotConfirmationModal()" type="button"
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
                        <a href="{{ route('dashboard') }}">
                            <button type="button"
                                class="py-2 px-4 md:px-6 md:py-3 inline-flex items-center gap-x-1 text-xs font-bold rounded-sm bg-accent text-white focus:outline-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-square-activity-icon lucide-square-activity">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <path d="M17 12h-2l-2 5-2-10-2 5H7" />
                                </svg>
                                Track
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div x-cloak x-show="isStopRobotConfirmationModalOpen"
                class="fixed top-0 left-0 h-svh w-full px-4 lg:px-96 pt-6 z-20 bg-dashboard">
                <div class="w-full h-full flex items-center justify-center">
                    <div class="max-w-sm mx-auto flex flex-col bg-navbar rounded-xl pointer-events-auto">
                        <div class="flex justify-between items-center py-3 px-4 dark:border-neutral-700">
                            <h3 class="font-bold text-gray-800 dark:text-white">
                            </h3>
                            <button x-on:click="toggleStopRobotConfirmationModal()" type="button"
                                class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                                aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto text-center">
                            <p class="text-white font-semibold text-xl">
                                Are you sure you want to stop the robot?
                            </p>
                        </div>
                        <div class="py-3 px-4">
                            <div>
                                <button type="button" x-on:click="destroy()" wire:click="stopRobot()" type="button"
                                    wire:loading.attr="disabled"
                                    class="p-3 w-full text-center text-sm font-semibold rounded-lg border border-transparent bg-accent text-white cursor-pointer hover:bg-accent-hover focus:outline-hidden focus:bg-accent disabled:opacity-50 disabled:pointer-events-none">
                                    Confirm
                                </button>
                            </div>
                            <div class="mt-3">
                                <button x-on:click="toggleStopRobotConfirmationModal()" type="button"
                                    class="p-3 w-full text-center text-sm font-semibold rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs cursor-pointer hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                    data-hs-overlay="#hs-vertically-centered-modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
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

        $wire.on('profit-incremented', (event) => {
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

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('traderoom', () => ({
            timer: '',
            timeLeft: {},
            timerInterval: null,
            isBotSearchingForSignal: '',
            isStopRobotConfirmationModalOpen: false,
            asset: '',
            assetIcon: '',
            sentiment: '',

            init() {
                // Start the timer when the component initializes
                this.startTimer();
            },

            startTimer() {
                this.timerInterval = setInterval(() => {
                    this.refreshTimer();
                }, 1000);
            },

            stopTimer() {
                if (this.timerInterval) {
                    clearInterval(this.timerInterval);
                    this.timerInterval = null;
                }
            },

            toggleStopRobotConfirmationModal() {
                this.isStopRobotConfirmationModalOpen = !this.isStopRobotConfirmationModalOpen;
            },

            calculateTimeLeftTillNextCheckpoint(checkpoint) {
                let difference = checkpoint - Date.now();

                if (0 > difference) {
                    return {
                        minutes: 0,
                        seconds: 0
                    }
                }

                let minutes = Math.floor((difference / (1000 * 60)) % 60);
                let seconds = Math.floor((difference / 1000) % 60);

                return {
                    minutes: minutes,
                    seconds: seconds
                }
            },

            formatTimeLeft(minutes, seconds) {
                let minuteString = 0;
                let secondString = 0;

                if (minutes < 10) {
                    minuteString = `0${String(minutes)}`;
                } else {
                    minuteString = String(minutes);
                }

                if (seconds < 10) {
                    secondString = `0${String(seconds)}`;
                } else {
                    secondString = String(seconds);
                }

                return `${minuteString}:${secondString}`;
            },

            toggleSearchingForSignals(minutes, seconds) {
                if (minutes === 5 && seconds > 0) {
                    this.isBotSearchingForSignal = true;
                }

                if (minutes === 5 && seconds === 0) {
                    this.isBotSearchingForSignal = false;
                }

                if (minutes <= 4) {
                    this.isBotSearchingForSignal = false;
                }

                if (minutes === 0 && seconds === 0) {
                    this.isBotSearchingForSignal = true;
                }
            },

            refreshTimer() {
                this.timeLeft = this.calculateTimeLeftTillNextCheckpoint(this.$wire
                .timerCheckpoint);
                this.asset = this.$wire.asset;
                this.assetIcon = `/${this.$wire.assetIcon}`
                this.sentiment = this.$wire.sentiment;

                if (Date.now() > this.$wire.timerCheckpoint) {
                    this.$wire.refreshAssetData();
                    this.timeLeft = this.calculateTimeLeftTillNextCheckpoint(this.$wire
                        .timerCheckpoint);
                    this.asset = this.$wire.asset;
                    this.assetIcon = `/${this.$wire.assetIcon}`;
                    this.sentiment = this.$wire.sentiment;
                    let nextCheckpoint = new Date(Number(this.$wire.timerCheckpoint)).getTime() + (
                        5 * 60 + 8) * 1000;
                    this.timeLeft = this.calculateTimeLeftTillNextCheckpoint(nextCheckpoint);
                }

                let formatted = this.formatTimeLeft(this.timeLeft.minutes, this.timeLeft.seconds);
                this.timer = formatted;

                this.toggleSearchingForSignals(this.timeLeft.minutes, this.timeLeft.seconds);
            },

            // Clean up when component is destroyed
            destroy() {
                this.stopTimer();
            }
        }))
    })
</script>
