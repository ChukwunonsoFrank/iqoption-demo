<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-80 lg:pt-6">
            <div class="mb-3 sticky top-0 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Make a deposit</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll">
                <div class="mb-4">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Amount</label>
                    <div class="relative">
                        <input type="text"
                            class="bg-navbar text-white border border-gray-700 text-sm peer py-2.5 sm:py-3 px-4 ps-11 block w-full rounded-lg sm:text-sm focus:outline-0"
                            placeholder="">
                        <div
                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                            <p class="text-white text-sm font-semibold">$</p>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="input-label" class="block text-xs font-medium mb-2 text-zinc-300">Payment method</label>
                    <div class="flex-1 md:flex-none relative">
                        <div x-on:click="$store.depositPage.togglePaymentMethodSelect()"
                            class="flex items-center space-x-3 py-2.5 sm:py-3 px-4 border border-gray-700 bg-navbar rounded-lg text-[#FFFFFF]">
                            <div class="flex-1">
                                <p class="text-sm">Bitcoin</p>
                                {{-- <template x-if="!selectedAccountBoolean">
                                    <p class="text-sm">Demo Account</p>
                                </template>
                                <template x-if="selectedAccountBoolean">
                                    <p class="text-sm">Real Account</p>
                                </template> --}}
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
                        <div x-cloak x-show="$store.depositPage.isPaymentMethodSelectOpen"
                            @click.outside="$store.depositPage.isPaymentMethodSelectOpen = false"
                            class="border-gray-700 bg-navbar absolute border rounded-lg w-full overflow-scroll z-10 p-2 mt-1">
                            <div x-on:click="$store.depositPage.isPaymentMethodSelectOpen = false"
                                class="hover:bg-gray-600 cursor-pointer flex items-center space-x-3 px-4 py-2 rounded-md text-[#FFFFFF]">
                                <div class="flex-1">
                                    <p class="text-sm">Bitcoin</p>
                                </div>
                            </div>
                            <div x-on:click="$store.depositPage.isPaymentMethodSelectOpen = false"
                                class="hover:bg-gray-600 cursor-pointer flex items-center space-x-3 px-4 py-2 rounded-md text-[#FFFFFF]">
                                <div class="flex-1">
                                    <p class="text-sm">Ethereum</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <a href="{{ route('dashboard.deposit.confirm') }}">
                        <button type="button"
                            class="py-3 cursor-pointer px-4 w-full md:px-6 md:py-3 text-center gap-x-2 text-sm md:text-base font-semibold rounded-lg bg-accent text-white focus:outline-hidden">
                            Proceed
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('depositPage', {
            isPaymentMethodSelectOpen: false,

            togglePaymentMethodSelect() {
                this.isPaymentMethodSelectOpen = !this.isPaymentMethodSelectOpen
            }
        })
    })
</script>
