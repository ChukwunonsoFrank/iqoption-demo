<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:pl-6 lg:pr-4">
            <div class="bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Referrals</h1>

                <p class="text-zinc-300 text-xs mt-3 leading-normal">Share your code, grow your network, and earn
                    rewards
                    as your referrals trade.</p>

                <div class="rounded-2xl bg-[#2c303a] p-5 mt-5">
                    <p class="text-xs text-zinc-300">
                        Total Commissions
                    </p>

                    <div class="mt-3 flex items-end justify-between">
                        <div>
                            <h4 class="text-2xl font-bold text-green-600">
                                @money($this->totalCommissions)
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="w-full space-y-3">
                        <div>
                            <div class="relative">
                                <input id="referral_code" type="text" id="hs-trailing-icon" name="hs-trailing-icon"
                                    class="py-3 px-4 pe-11 block w-full border border-dashed border-white text-white bg-[#2c303a] rounded-lg font-mono font-bold text-xs focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                    value="{{ 'https://bullfex.com/register?ref=' . auth()->user()->referral_code }}"
                                    readonly>
                                <div x-on:click="$store.showReferralsPage.copyWalletAddress()"
                                    class="absolute inset-y-0 end-0 flex items-center cursor-pointer z-20 pe-4">
                                    <svg class="js-clipboard-default size-4 group-hover:rotate-6 transition"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="8" height="4" x="8" y="2" rx="1" ry="1">
                                        </rect>
                                        <path
                                            d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Earnings</h1>
            </div>

            <div class="mt-4 pb-24 h-96 md:h-[38rem] lg:h-80 overflow-scroll scrollbar-hide">
                @forelse ($referrals as $referral)
                    <div wire:key="referral-{{ $referral['id'] }}"
                        class="bg-trade w-full rounded-sm flex flex-col space-y-2 p-3 mb-3">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <span
                                    class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-xs bg-trade-badge text-white">LEVEL
                                    {{ $referral['level'] }}</span>
                            </div>
                            <div class="flex-1 text-end">
                                <p class="text-gray-400 text-xs">{{ $referral['created_at_formatted'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-1">
                            <div class="flex-none">
                                <p class="font-semibold text-xs text-white md:text-sm">{{ $referral->user->name }}</p>
                            </div>
                            <div class="flex-1 pb-1">
                                <span
                                    class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-[9px] font-semibold bg-green-600 text-white">{{ $this->getLevelPercentage($referral['level']) }}</span>
                            </div>
                            <div class="flex-none text-end">
                                <p class="font-semibold text-sm md:text-base text-green-500">+@money($referral['amount'] / 100)</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex justify-center items-center">
                        <div class="bg-trade w-full rounded-sm flex flex-col space-y-2 p-3 mb-3">
                            <div class="text-center">
                                <p class="text-xs text-zinc-300">No redeemed referrals yet.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
                @if ($showLoadMoreButton)
                    <div class="flex justify-center">
                        <button wire:click="loadMore" wire:loading.attr="disabled" type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-normal rounded-full border border-gray-400 text-white shadow-2xs cursor-pointer disabled:opacity-50 disabled:pointer-events-none">
                            <span wire:loading.remove wire:target="loadMore">Load more</span>
                            <i wire:loading.remove wire:target="loadMore" class="fas fa-rotate"></i>
                            <i wire:loading class="fas fa-rotate fa-spin"></i>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('showReferralsPage', {
            toast() {
                const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">Copied</p>
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
            },

            copyWalletAddress() {
                var copyText = document.getElementById("referral_code");
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices
                navigator.clipboard.writeText(copyText.value);
                this.toast();
            }
        })
    })
</script>
