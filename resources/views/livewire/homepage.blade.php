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
                                <img src="{{ $data['iconUrlPath'] }}" alt="" srcset="">
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-semibold mb-0.5">{{ $data['name'] }}</p>
                                <p class="text-xs font-medium text-gray-400">{{ $data['symbol'] }}</p>
                            </div>
                            <div class="flex-1 text-end">
                                <a href="#"
                                    class="rounded-xs border border-accent w-24 px-1 pt-1 pb-0 text-center inline-block text-accent hover:bg-accent-hover">
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
    </div>
    <!-- Assets tab end -->
</div>
