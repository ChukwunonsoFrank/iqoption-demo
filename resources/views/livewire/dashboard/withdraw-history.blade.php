<div class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:pl-6 lg:pr-4">
            <div class="mb-3 sticky top-0 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Withdrawals</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll">

                @forelse ($withdrawals as $withdrawal)
                    <div wire:key="withdrawal-{{ $withdrawal['id'] }}" class="bg-trade w-full rounded-sm flex flex-col space-y-2 p-3 mb-3">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <span
                                    class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-[10px] font-semibold border border-gray-500 text-white"><span
                                        class="size-1 inline-block rounded-full {{ $withdrawal['status'] === 'pending' ? 'bg-red-600' : 'bg-green-600' }}"></span> {{ ucfirst($withdrawal['status']) }}</span>
                            </div>
                            <div class="flex-1 text-end">
                                <p class="text-gray-400 text-xs">{{ $withdrawal['created_at_formatted'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="flex-none">
                                <img class="md:w-7" src="{{ asset($this->getPaymentMethodIconUrl($withdrawal['payment_method'])) }}" alt="">
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-xs text-white md:text-sm">{{ $withdrawal['payment_method'] }}</p>
                            </div>
                            <div class="flex-none text-end">
                                <p class="font-semibold text-sm md:text-base text-white">-@money($withdrawal['amount'] / 100)</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex justify-center items-center">
                        <div class="bg-trade w-full rounded-sm flex flex-col space-y-2 p-3 mb-3">
                            <div class="text-center">
                                <p class="text-xs text-zinc-300">Make withdrawals to see your activity here.</p>
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

@script
    <script>
        $wire.on('withdrawal-created', (event) => {
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
                duration: 6000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript
