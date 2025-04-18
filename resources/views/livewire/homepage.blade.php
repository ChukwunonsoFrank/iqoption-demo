<div>
    <!-- Hero section start -->
    <div class="mx-auto px-8 h-80 hero-banner border">
        <div class="mt-16 text-center w-full">
            <h1 class="text-white text-2xl md:text-3xl font-bold w-72 md:w-82 mx-auto tracking-tight">Trade
                Stocks, Crypto and
                Forex</h1>
            <div class="flex justify-center items-center space-x-4 mt-8">
                <a href="#"
                    class="rounded-sm bg-accent px-18 py-3.5 text-sm inline-block font-medium text-white shadow-xs hover:bg-accent-hover">Trade
                    Now</a>
                <a href="#"
                    class="hidden md:inline-block rounded-sm border border-white p-4 text-sm font-medium text-white shadow-xs hover:bg-white hover:text-zinc-700">Free
                    Practice Account</a>
            </div>
        </div>
    </div>
    <!-- Hero section end -->

    <!-- Assets tab start -->
    <div class="-mt-14 mx-auto px-4">
        <div>
            <nav class="-mb-0.5 flex justify-center gap-x-6" aria-label="Tabs" role="tablist"
                aria-orientation="horizontal">
                <button type="button"
                    class="hs-tab-active:font-semibold hs-tab-active:border-white font-semibold py-1 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-lg whitespace-nowrap text-white hover:text-blue-600 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500 active"
                    id="horizontal-alignment-item-1" aria-selected="true" data-hs-tab="#horizontal-alignment-1"
                    aria-controls="horizontal-alignment-1" role="tab">
                    Crypto
                </button>
                <button type="button"
                    class="hs-tab-active:font-semibold hs-tab-active:border-white font-semibold py-1 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-lg whitespace-nowrap text-white hover:text-blue-600 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500"
                    id="horizontal-alignment-item-2" aria-selected="false" data-hs-tab="#horizontal-alignment-2"
                    aria-controls="horizontal-alignment-2" role="tab">
                    Forex
                </button>
                <button type="button"
                    class="hs-tab-active:font-semibold hs-tab-active:border-white font-semibold py-1 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-lg whitespace-nowrap text-white hover:text-blue-600 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500"
                    id="horizontal-alignment-item-3" aria-selected="false" data-hs-tab="#horizontal-alignment-3"
                    aria-controls="horizontal-alignment-3" role="tab">
                    Stocks
                </button>
            </nav>
        </div>

        <div class="mt-10">
            <div id="horizontal-alignment-1" role="tabpanel" aria-labelledby="horizontal-alignment-item-1">
                <div class="flex items-center space-x-1">
                    <div>
                        <h3 class="text-zinc-700 font-bold text-lg">
                            73 <span class="font-medium">Cryptocurrencies</span>
                        </h3>
                    </div>
                    <div>
                        <i class="fas fa-angle-right text-lg inline-block mt-1 text-accent"></i>
                    </div>
                </div>

                <div class="flex items-center justify-between space-x-2 mt-4">
                    <div class="flex-none w-36">
                        <p class="text-zinc-700 font-bold text-xl">$100</p>
                        <p class="text-xs font-medium">Min deposit</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-zinc-700 font-bold text-xl">$10</p>
                        <p class="text-xs font-medium">Minimum investment</p>
                    </div>
                </div>

                <div class="mt-4">
                    @foreach ($marketData as $data)
                        <div wire:key="market-data-crypto-{{ $data['symbol'] }}"
                            class="flex items-center border-b border-gray-100 py-3">
                            <div class="flex-none w-12">
                                <img src="{{ asset($data['iconUrlPath']) }}" width="30" alt=""
                                    srcset="">
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-semibold mb-0.5">{{ $data['name'] }}</p>
                                <p class="text-xs font-medium text-gray-400">{{ $data['symbol'] }}</p>
                            </div>
                            <div class="flex-1 text-end">
                                <a href="#"
                                    class="rounded-xs border border-accent w-24 px-1 pt-1 pb-0 text-center inline-block text-accent hover:bg-accent-hover hover:text-white">
                                    <span class="block font-medium text-sm">{{ $data['priceUsd'] }}</span>
                                    <span class="block font-normal text-[11px]">Trade</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="horizontal-alignment-2" class="hidden" role="tabpanel"
                aria-labelledby="horizontal-alignment-item-2">
                <p class="text-gray-500 dark:text-neutral-400">
                    This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">second</em>
                    item's
                    tab body.
                </p>
            </div>
            <div id="horizontal-alignment-3" class="hidden" role="tabpanel"
                aria-labelledby="horizontal-alignment-item-3">
                <p class="text-gray-500 dark:text-neutral-400">
                    This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">third</em> item's
                    tab
                    body.
                </p>
            </div>
        </div>

        <div class="text-center mt-4">
            <p class="text-gray-400 leading-4 font-medium text-[11px]">* Information regarding past performance is not a
                reliable indicator of future performance. Leverage restrictions may apply depending on client's
                circumstances and/or jurisdiction.</p>
        </div>
    </div>
    <!-- Assets tab end -->

    <!-- Payment methods slider start -->
    <div class="mt-12 mb-6 text-center">
        <h2 class="text-accent font-medium text-xl mb-2">Deposits & Withdrawals</h2>
        <p class="text-sm font-medium text-gray-600 leading-6">Choose between multiple payment systems to withdraw and
            deposit your funds quickly and securely.</p>
    </div>

    <div data-hs-carousel='{
    "loadingClasses": "opacity-0",
    "dotsItemClasses": "hs-carousel-active:bg-gray-400 hs-carousel-active:border-gray-400 size-1.5 border border-gray-400 rounded-full cursor-pointer",
    "slidesQty": {
      "xs": 3,
      "lg": 3
    }
  }'
        class="relative">
        <div class="hs-carousel w-full overflow-hidden bg-white">
            <div class="relative min-h-18 -mx-1">
                <div
                    class="hs-carousel-body absolute top-0 bottom-0 start-0 flex space-x-2 flex-nowrap opacity-0 transition-transform duration-700">
                    <div class="hs-carousel-slide px-1">
                        <div class="flex justify-center h-full bg-gray-100 p-6">
                            <img src="{{ asset('assets/icons/skrill.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                    <div class="hs-carousel-slide px-1">
                        <div class="flex justify-center h-full bg-gray-100 p-6">
                            <img src="{{ asset('assets/icons/volet.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                    <div class="hs-carousel-slide px-1">
                        <div class="flex justify-center h-full bg-gray-100 p-6">
                            <img src="{{ asset('assets/icons/neteller.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                    <div class="hs-carousel-slide px-1">
                        <div class="flex justify-center h-full bg-gray-100 p-6">
                            <img src="{{ asset('assets/icons/mastercard.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                    <div class="hs-carousel-slide px-1">
                        <div class="flex justify-center h-full bg-gray-100 p-6">
                            <img src="{{ asset('assets/icons/wire-transfer.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                    <div class="hs-carousel-slide px-1">
                        <div class="flex justify-center h-full bg-gray-100 p-6">
                            <img src="{{ asset('assets/icons/visa.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                    <div class="hs-carousel-slide px-1">
                        <div class="flex justify-center h-full bg-gray-100 p-6">
                            <img src="{{ asset('assets/icons/visa-plus-mastercard.svg') }}" alt=""
                                srcset="">
                        </div>
                    </div>
                    <div class="hs-carousel-slide px-1">
                        <div class="flex justify-center h-full bg-gray-100 p-6">
                            <img src="{{ asset('assets/icons/volet-usd.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hs-carousel-pagination flex justify-center absolute -bottom-6 start-0 end-0 gap-x-2"></div>
    </div>

    <div class="mt-12 text-center">
        <a href="#"
            class="rounded-xs bg-accent px-6 py-3.5 text-sm inline-block font-medium text-white shadow-xs hover:bg-accent-hover">Open account</a>
    </div>

    <!-- Payment methods slider end -->
</div>
