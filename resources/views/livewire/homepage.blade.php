<div class="mt-14">
    <!-- Hero section start -->
    <div class="mx-auto px-8 lg:px-64 h-96 lg:h-[35rem] hero-banner border">
        <div class="mt-16 text-center w-full lg:text-start">
            <h1
                class="text-white mb-6 text-2xl md:text-3xl lg:text-4xl font-bold w-72 md:w-82 mx-auto lg:mx-0 tracking-tight lg:leading-12">
                Trade
                Stocks, Crypto and
                Forex</h1>
            <p class="text-white text-xs font-medium mb-6 mx-auto md:w-[28rem] md:text-[14px] lg:mx-0">Save hours of
                manual trading with our advanced trading bots across 150+ most popular asset exchanges.</p>
            <div class="flex justify-center items-center lg:justify-start space-x-4">
                <a href="{{ route('register') }}" wire:navigate
                    class="rounded-sm bg-accent px-18 py-3.5 text-sm inline-block font-medium text-white shadow-xs hover:bg-accent-hover">Trade
                    Now</a>
                <a href="{{ route('register') }}" wire:navigate
                    class="hidden md:inline-block rounded-sm border border-white px-4 py-3.5 text-sm font-medium text-white shadow-xs hover:bg-white hover:text-zinc-700">Free
                    Practice Account</a>
            </div>
        </div>
    </div>
    <!-- Hero section end -->

    <!-- Assets tab start -->
    <div class="-mt-14 lg:-mt-48 mx-auto px-4 lg:px-64 lg:mb-40 md:px-12 md:mb-28">
        <div>
            <nav wire:ignore class="-mb-0.5 flex justify-center gap-x-6" aria-label="Tabs" role="tablist"
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

        <div class="mt-10 lg:bg-white lg:p-6 lg:rounded-sm lg:shadow-sm">
            <div id="horizontal-alignment-1" role="tabpanel" aria-labelledby="horizontal-alignment-item-1">
                <div class="lg:flex lg:items-center lg:mb-5">
                    <div class="flex-1 flex items-center space-x-1 mb-5 lg:mb-0">
                        <div>
                            <h3 class="text-zinc-700 font-bold text-lg md:text-2xl">
                                73 <span class="font-medium">Cryptocurrencies</span>
                            </h3>
                        </div>
                        <div>
                            <i class="fas fa-angle-right text-lg inline-block mt-1 text-accent"></i>
                        </div>
                    </div>

                    <div class="flex-1 flex items-center justify-between space-x-2 mb-5 lg:mb-0 md:mb-8">
                        <div class="flex-none w-36">
                            <p class="text-zinc-700 font-bold text-xl">$100</p>
                            <p class="text-zinc-700 text-xs font-medium">Min deposit</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-zinc-700 font-bold text-xl">$10</p>
                            <p class="text-zinc-700 text-xs font-medium">Minimum investment</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="hidden md:flex items-center border-b border-gray-200 py-3.5">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-gray-400">Name</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-medium text-gray-400">1D Change</p>
                        </div>
                    </div>
                    @foreach ($cryptoMarketData as $data)
                        <div wire:key="market-data-crypto-{{ $data['symbol'] }}"
                            class="flex items-center border-b border-gray-100 py-3.5">
                            <div class="flex-1 flex items-center">
                                <div class="flex-none w-12">
                                    <img src="{{ asset($data['iconUrlPath']) }}" width="30" alt=""
                                        srcset="">
                                </div>
                                <div class="shrink">
                                    <p class="text-xs md:text-sm text-zinc-700 font-semibold mb-0.5">{{ $data['name'] }}
                                    </p>
                                    <p class="text-xs font-medium text-gray-400">{{ $data['symbol'] }}</p>
                                </div>
                            </div>
                            <div class="flex-1 text-end md:flex md:items-center md:space-x-3">
                                <div class="hidden md:block flex-1 text-start">
                                    <p class="text-sm font-medium">+1.45%</p>
                                </div>
                                <div class="flex-none">
                                    <a href="{{ route('register') }}" wire:navigate
                                        class="rounded-xs border border-accent w-24 px-1 pt-1 pb-0 text-center inline-block text-accent hover:bg-accent-hover hover:text-white active:bg-accent-hover active:text-white">
                                        <span class="block font-medium text-sm">{{ $data['priceUsd'] }}</span>
                                        <span class="block md:hidden font-medium text-[11px]">Trade</span>
                                        <span class="hidden md:block font-medium text-[11px]">Sell</span>
                                    </a>
                                </div>
                                <div class="hidden md:block flex-none">
                                    <a href="{{ route('register') }}" wire:navigate
                                        class="inline-block rounded-xs border border-buy-green w-24 px-1 pt-1 pb-0 text-center text-buy-green hover:bg-buy-green hover:text-white active:bg-buy-green active:text-white">
                                        <span class="block font-medium text-sm">{{ $data['priceUsd'] }}</span>
                                        <span class="block font-medium text-[11px]">Buy</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="horizontal-alignment-2" class="hidden" role="tabpanel"
                aria-labelledby="horizontal-alignment-item-2">
                <div class="lg:flex lg:items-center lg:mb-5">
                    <div class="flex-1 flex items-center space-x-1 mb-5 lg:mb-0">
                        <div>
                            <h3 class="text-zinc-700 font-bold text-lg md:text-2xl">
                                43 <span class="font-medium">Forex pairs</span>
                            </h3>
                        </div>
                        <div>
                            <i class="fas fa-angle-right text-lg inline-block mt-1 text-accent"></i>
                        </div>
                    </div>

                    <div class="flex-1 flex items-center justify-between space-x-2 mb-5 lg:mb-0 md:mb-8">
                        <div class="flex-none w-36">
                            <p class="text-zinc-700 font-bold text-xl">$100</p>
                            <p class="text-zinc-700 text-xs font-medium">Min deposit</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-zinc-700 font-bold text-xl">$10</p>
                            <p class="text-zinc-700 text-xs font-medium">Minimum investment</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="hidden md:flex items-center border-b border-gray-200 py-3.5">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-gray-400">Name</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-medium text-gray-400">1D Change</p>
                        </div>
                    </div>
                    @foreach ($forexMarketData as $data)
                        <div wire:key="market-data-forex-{{ $data['symbol'] }}"
                            class="flex items-center border-b border-gray-100 py-3.5">
                            <div class="flex-1 flex items-center">
                                <div class="flex-none w-12">
                                    <img src="{{ asset($data['iconUrlPath']) }}" width="30" alt=""
                                        srcset="">
                                </div>
                                <div class="shrink">
                                    <p class="text-xs md:text-sm text-zinc-700 font-semibold mb-0.5">
                                        {{ $data['name'] }}
                                    </p>
                                    <p class="text-xs font-medium text-gray-400">{{ $data['symbol'] }}</p>
                                </div>
                            </div>
                            <div class="flex-1 text-end md:flex md:items-center md:space-x-3">
                                <div class="hidden md:block flex-1 text-start">
                                    <p class="text-sm font-medium">+1.45%</p>
                                </div>
                                <div class="flex-none">
                                    <a href="{{ route('register') }}" wire:navigate
                                        class="rounded-xs border border-accent w-24 px-1 pt-1 pb-0 text-center inline-block text-accent hover:bg-accent-hover hover:text-white active:bg-accent-hover active:text-white">
                                        <span class="block font-medium text-sm">{{ $data['price'] }}</span>
                                        <span class="block md:hidden font-medium text-[11px]">Trade</span>
                                        <span class="hidden md:block font-medium text-[11px]">Sell</span>
                                    </a>
                                </div>
                                <div class="hidden md:block flex-none">
                                    <a href="{{ route('register') }}" wire:navigate
                                        class="inline-block rounded-xs border border-buy-green w-24 px-1 pt-1 pb-0 text-center text-buy-green hover:bg-buy-green hover:text-white active:bg-buy-green active:text-white">
                                        <span class="block font-medium text-sm">{{ $data['price'] }}</span>
                                        <span class="block font-medium text-[11px]">Buy</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="horizontal-alignment-3" class="hidden" role="tabpanel"
                aria-labelledby="horizontal-alignment-item-3">
                <div class="lg:flex lg:items-center lg:mb-5">
                    <div class="flex-1 flex items-center space-x-1 mb-5 lg:mb-0">
                        <div>
                            <h3 class="text-zinc-700 font-bold text-lg md:text-2xl">
                                276 <span class="font-medium">Stocks</span>
                            </h3>
                        </div>
                        <div>
                            <i class="fas fa-angle-right text-lg inline-block mt-1 text-accent"></i>
                        </div>
                    </div>

                    <div class="flex-1 flex items-center justify-between space-x-2 mb-5 lg:mb-0 md:mb-8">
                        <div class="flex-none w-36">
                            <p class="text-zinc-700 font-bold text-xl">$100</p>
                            <p class="text-zinc-700 text-xs font-medium">Min deposit</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-zinc-700 font-bold text-xl">$10</p>
                            <p class="text-zinc-700 text-xs font-medium">Minimum investment</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="hidden md:flex items-center border-b border-gray-200 py-3.5">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-gray-400">Name</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-medium text-gray-400">1D Change</p>
                        </div>
                    </div>
                    @foreach ($stocksMarketData as $data)
                        <div wire:key="market-data-stocks-{{ $data['symbol'] }}"
                            class="flex items-center border-b border-gray-100 py-3.5">
                            <div class="flex-1 flex items-center">
                                <div class="flex-none w-12">
                                    <img src="{{ asset($data['iconUrlPath']) }}" width="30" alt=""
                                        srcset="">
                                </div>
                                <div class="shrink">
                                    <p class="text-xs md:text-sm text-zinc-700 font-semibold mb-0.5">
                                        {{ $data['name'] }}
                                    </p>
                                    <p class="text-xs font-medium text-gray-400">{{ $data['symbol'] }}</p>
                                </div>
                            </div>
                            <div class="flex-1 text-end md:flex md:items-center md:space-x-3">
                                <div class="hidden md:block flex-1 text-start">
                                    <p class="text-sm font-medium">+1.45%</p>
                                </div>
                                <div class="flex-none">
                                    <a href="{{ route('register') }}" wire:navigate
                                        class="rounded-xs border border-accent w-24 px-1 pt-1 pb-0 text-center inline-block text-accent hover:bg-accent-hover hover:text-white active:bg-accent-hover active:text-white">
                                        <span class="block font-medium text-sm">{{ $data['price'] }}</span>
                                        <span class="block md:hidden font-medium text-[11px]">Trade</span>
                                        <span class="hidden md:block font-medium text-[11px]">Sell</span>
                                    </a>
                                </div>
                                <div class="hidden md:block flex-none">
                                    <a href="{{ route('register') }}" wire:navigate
                                        class="inline-block rounded-xs border border-buy-green w-24 px-1 pt-1 pb-0 text-center text-buy-green hover:bg-buy-green hover:text-white active:bg-buy-green active:text-white">
                                        <span class="block font-medium text-sm">{{ $data['price'] }}</span>
                                        <span class="block font-medium text-[11px]">Buy</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-center mt-4 lg:mx-auto lg:px-8">
            <p class="text-gray-400 leading-4 font-medium text-[11px]">* Information regarding past performance is not
                a
                reliable indicator of future performance. Leverage restrictions may apply depending on client's
                circumstances and/or jurisdiction.</p>
        </div>
    </div>
    <!-- Assets tab end -->

    <!-- Featured in start -->
    <div class="mb-28 px-4 lg:px-32">
        <div class="mt-28 mb-6 text-center">
            <h2 class="text-zinc-700 font-bold text-md mb-2">FEATURED IN</h2>
        </div>
        <div
            class="grid justify-center grid-cols-2 gap-x-6 gap-y-3 md:grid-cols-3 md:gap-y-4 lg:grid-cols-6 lg:gap-x-0">
            <div class="text-center">
                <img class="inline" src="{{ asset('assets/icons/yahoo.svg') }}">
            </div>
            <div class="text-center">
                <img class="inline" src="{{ asset('assets/icons/beincrypto.svg') }}">
            </div>
            <div class="text-center">
                <img class="inline" src="{{ asset('assets/icons/cryptopotato.svg') }}">
            </div>
            <div class="text-center">
                <img class="inline" src="{{ asset('assets/icons/blockonomi.svg') }}">
            </div>
            <div class="text-center">
                <img class="inline" src="{{ asset('assets/icons/benzinga.svg') }}">
            </div>
            <div class="text-center">
                <img class="inline" src="{{ asset('assets/icons/newsbtc.svg') }}">
            </div>
        </div>
    </div>
    <!-- Featured in end -->

    <!-- Payment methods slider start -->
    <div class="mb-28 lg:mb-24">
        <div class="mt-12 mb-6 text-center lg:mb-14">
            <h2 class="text-accent font-normal text-xl md:text-3xl lg:text-4xl mb-2">Deposits & Withdrawals</h2>
            <p class="text-sm md:text-base font-medium text-gray-600 leading-6 w-80 md:w-[80%] mx-auto">Choose between
                multiple payment systems
                to withdraw
                and
                deposit your funds quickly and securely.</p>
        </div>

        <div class="mx-auto px-4 md:px-48 lg:px-96">
            <div data-hs-carousel='{
            "loadingClasses": "opacity-0",
            "dotsItemClasses": "hs-carousel-active:bg-gray-400 hs-carousel-active:border-gray-400 size-1.5 border border-gray-400 rounded-full cursor-pointer",
            "slidesQty": {
              "xs": 3,
              "lg": 6
            }
          }'
                class="relative">
                <div class="hs-carousel w-full overflow-hidden bg-white">
                    <div class="relative min-h-18 -mx-1">
                        <div
                            class="hs-carousel-body absolute top-0 bottom-0 start-0 flex space-x-2 flex-nowrap opacity-0 transition-transform duration-700">
                            <div class="hs-carousel-slide px-1">
                                <div class="flex justify-center h-full bg-gray-100 p-4">
                                    <img src="{{ asset('assets/icons/btc.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                            <div class="hs-carousel-slide px-1">
                                <div class="flex justify-center h-full bg-gray-100 p-4">
                                    <img src="{{ asset('assets/icons/eth.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                            <div class="hs-carousel-slide px-1">
                                <div class="flex justify-center h-full bg-gray-100 p-4">
                                    <img src="{{ asset('assets/icons/usdt.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                            <div class="hs-carousel-slide px-1">
                                <div class="flex justify-center h-full bg-gray-100 p-4">
                                    <img src="{{ asset('assets/icons/sol.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                            <div class="hs-carousel-slide px-1">
                                <div class="flex justify-center h-full bg-gray-100 p-4">
                                    <img src="{{ asset('assets/icons/trx.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                            <div class="hs-carousel-slide px-1">
                                <div class="flex justify-center h-full bg-gray-100 p-4">
                                    <img src="{{ asset('assets/icons/bnb.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                            <div class="hs-carousel-slide px-1">
                                <div class="flex justify-center h-full bg-gray-100 p-4">
                                    <img src="{{ asset('assets/icons/ltc.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hs-carousel-pagination flex justify-center absolute -bottom-6 start-0 end-0 gap-x-2"></div>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('register') }}" wire:navigate
                class="rounded-xs bg-accent px-6 py-3.5 text-sm inline-block font-medium text-white shadow-xs hover:bg-accent-hover">Open
                account</a>
        </div>
    </div>
    <!-- Payment methods slider end -->

    <!-- Plaform features start -->
    <div class="mb-6 mx-auto px-4 md:px-12 md:mb-16">
        <div class="lg:flex lg:items-center lg:justify-around lg:mx-auto lg:px-28">
            <div class="flex items-start space-x-3 mb-6 lg:flex-col">
                <div class="flex-none w-20 lg:mb-6 lg:flex-1 lg:w-full lg:text-center">
                    <img class="lg:inline" src="{{ asset('assets/icons/features-devices.svg') }}" alt=""
                        srcset="">
                </div>
                <div class="flex-1 lg:text-center">
                    <h3 class="text-zinc-700 font-bold text-md mb-2">Advanced Platform</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 tracking-wide">Web & Mobile</p>
                    <a href="#" class="text-accent text-sm font-medium">Download App</a>
                </div>
            </div>
            <div class="flex items-start space-x-3 mb-6 lg:flex-col">
                <div class="flex-none w-20 lg:mb-6 lg:flex-1 lg:w-full lg:text-center">
                    <img class="lg:inline" src="{{ asset('assets/icons/features-graduation-cap.svg') }}"
                        alt="" srcset="">
                </div>
                <div class="flex-1 lg:text-center">
                    <h3 class="text-zinc-700 font-bold text-md mb-2">Free Practice</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 tracking-wide lg:w-44">Refillable free Practice
                        Account of
                        $10,000</p>
                    <a href="{{ route('register') }}" wire:navigate class="text-accent text-sm font-medium">Try Practice
                        Account</a>
                </div>
            </div>
            <div class="flex items-start space-x-3 lg:flex-col lg:mb-6">
                <div class="flex-none w-20 lg:mb-6 lg:flex-1 lg:w-full lg:text-center">
                    <img class="lg:inline" src="{{ asset('assets/icons/features-headphones.svg') }}" alt=""
                        srcset="">
                </div>
                <div class="flex-1 lg:text-center">
                    <h3 class="text-zinc-700 font-bold text-md mb-2">Customer Service</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 tracking-wide">Prompt multilingual support</p>
                    <div class="flex space-x-2 mb-2 lg:justify-center">
                        <div><img width="20" src="{{ asset('assets/icons/multilingual-flag-1.svg') }}"
                                alt=""></div>
                        <div><img width="20" src="{{ asset('assets/icons/multilingual-flag-2.svg') }}"
                                alt=""></div>
                        <div><img width="20" src="{{ asset('assets/icons/multilingual-flag-3.svg') }}"
                                alt=""></div>
                        <div><img width="20" src="{{ asset('assets/icons/multilingual-flag-4.svg') }}"
                                alt=""></div>
                        <div><img width="20" src="{{ asset('assets/icons/multilingual-flag-5.svg') }}"
                                alt=""></div>
                    </div>
                    <div class="flex space-x-2 lg:justify-center">
                        <div><img width="20" src="{{ asset('assets/icons/multilingual-flag-6.svg') }}"
                                alt=""></div>
                        <div><img width="20" src="{{ asset('assets/icons/multilingual-flag-7.svg') }}"
                                alt=""></div>
                        <div><img width="20" src="{{ asset('assets/icons/multilingual-flag-8.svg') }}"
                                alt=""></div>
                        <div><img width="20" src="{{ asset('assets/icons/multilingual-flag-9.svg') }}"
                                alt=""></div>
                        <div><img width="20" src="{{ asset('assets/icons/multilingual-flag-10.svg') }}"
                                alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Plaform features end -->

    <!-- Platform links start -->
    <div class="mx-auto px-4 md:px-12 lg:mb-16">
        <div class="mt-12 mb-6">
            <h2 class="text-accent font-normal text-center text-xl md:text-3xl lg:text-4xl mb-4">Enjoy the ease of
                access</h2>
            <p
                class="text-sm md:text-base font-medium text-gray-600 text-center md:text-start lg:text-center lg:mx-auto leading-6 lg:w-[46rem]">
                A multichart
                layout, technical analysis, historical
                quotes and beyond. Everything you're looking for in a platform — on the device of your choice.</p>
        </div>
        <div class="md:flex md:items-center md:justify-center">
            <div>
                <div
                    class="flex md:inline-flex md:mr-1.5 group items-center space-x-3 mx-auto rounded-sm bg-white border border-accent p-1.5 mb-3 w-48 text-sm font-medium shadow-xs hover:bg-accent active:bg-accent">
                    <div>
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="group-hover:fill-white group-active:fill-white"
                                d="M16.6025 14.7823C16.4378 14.7823 16.2768 14.7335 16.1398 14.642C16.0028 14.5505 15.896 14.4205 15.833 14.2683C15.7699 14.1161 15.7534 13.9487 15.7855 13.7871C15.8176 13.6255 15.8969 13.4771 16.0133 13.3606C16.1298 13.2441 16.2782 13.1648 16.4397 13.1326C16.6013 13.1004 16.7688 13.1169 16.921 13.1799C17.0732 13.2429 17.2033 13.3496 17.2948 13.4866C17.3863 13.6235 17.4352 13.7845 17.4352 13.9493C17.435 14.1701 17.3472 14.3818 17.1911 14.5379C17.035 14.6941 16.8233 14.782 16.6025 14.7823ZM7.39745 14.7823C7.23272 14.7823 7.07168 14.7335 6.9347 14.642C6.79771 14.5505 6.69094 14.4205 6.62787 14.2683C6.5648 14.1161 6.54828 13.9487 6.58039 13.7871C6.61249 13.6255 6.69179 13.4771 6.80825 13.3606C6.9247 13.2441 7.07309 13.1648 7.23465 13.1326C7.3962 13.1004 7.56367 13.1169 7.71587 13.1799C7.86807 13.2429 7.99817 13.3496 8.08971 13.4866C8.18126 13.6235 8.23013 13.7845 8.23016 13.9493C8.22996 14.1701 8.14217 14.3818 7.98606 14.538C7.82994 14.6941 7.61826 14.782 7.39745 14.7823ZM16.9012 9.7658L18.5655 6.88314C18.5883 6.84377 18.6031 6.80029 18.609 6.75521C18.615 6.71012 18.612 6.6643 18.6003 6.62036C18.5885 6.57642 18.5682 6.53523 18.5406 6.49913C18.5129 6.46303 18.4784 6.43273 18.439 6.40997C18.3997 6.38721 18.3562 6.37242 18.3111 6.36646C18.266 6.3605 18.2202 6.36347 18.1762 6.37522C18.1323 6.38697 18.0911 6.40725 18.055 6.43492C18.0189 6.46258 17.9886 6.49709 17.9659 6.53646L16.2805 9.45553C14.9917 8.86732 13.5443 8.53979 11.9998 8.53979C10.4554 8.53979 9.00811 8.86779 7.71933 9.45553L6.03412 6.53646C6.01138 6.49708 5.98112 6.46256 5.94504 6.43487C5.90897 6.40718 5.86779 6.38687 5.82387 6.37509C5.77995 6.36332 5.73413 6.36031 5.68905 6.36624C5.64396 6.37217 5.60049 6.38692 5.5611 6.40966C5.52172 6.43239 5.48719 6.46266 5.45951 6.49873C5.43182 6.5348 5.41151 6.57598 5.39973 6.6199C5.38796 6.66382 5.38495 6.70964 5.39088 6.75472C5.39681 6.79981 5.41156 6.84329 5.43429 6.88267L7.09879 9.7658C4.24077 11.3202 2.28594 14.2136 2 17.632H22C21.7137 14.2136 19.759 11.3202 16.9012 9.7658Z"
                                fill="#25258E" />
                        </svg>

                    </div>
                    <div>
                        <p class="text-zinc-700 group-hover:text-white group-active:text-white font-semibold">For
                            Mobile
                        </p>
                        <p class="text-gray-400 group-hover:text-white group-active:text-white text-[11px]">.apk 21.5
                            Mb
                        </p>
                    </div>
                </div>

                <a href="{{ route('login') }}">
                    <div
                        class="flex md:inline-flex md:ml-1.5 group items-center space-x-3 mx-auto rounded-sm bg-white border border-accent p-1.5 w-48 text-sm font-medium shadow-xs hover:bg-accent active:bg-accent">
                        <div>
                            <svg width="40" height="40" viewBox="0 0 24 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="group-hover:fill-white group-active:fill-white"
                                    d="M8.75 12.2141C8.75 11.1741 8.79402 10.1195 8.88791 9.10256C9.90434 9.0088 10.9583 8.96484 11.9976 8.96484C13.0381 8.96484 14.0933 9.0089 15.1107 9.10287C15.2046 10.1197 15.2486 11.1742 15.2486 12.2141C15.2486 13.2539 15.2046 14.3084 15.1107 15.3254C14.0933 15.4193 13.0381 15.4634 11.9977 15.4634C10.9583 15.4634 9.90434 15.4194 8.88789 15.3257C8.79402 14.3086 8.75 13.254 8.75 12.2141Z"
                                    fill="#25258E" />
                                <path class="group-hover:fill-white group-active:fill-white"
                                    d="M7.25 12.2132C7.25 11.2485 7.2864 10.2586 7.36623 9.28516C6.4869 9.41842 5.66091 9.59554 4.92779 9.82096C3.95114 10.1212 3.19335 10.4911 2.69303 10.9133C2.23786 11.2974 2.02439 11.6957 2.00035 12.1295C2.00012 12.1575 2 12.1856 2 12.2138C2 12.2415 2.00011 12.2691 2.00034 12.2967C2.02432 12.7306 2.23779 13.129 2.69303 13.5131C3.19335 13.9353 3.95114 14.3052 4.92779 14.6055C5.66091 14.8309 6.4869 15.008 7.36623 15.1413C7.28639 14.1678 7.25 13.1779 7.25 12.2132Z"
                                    fill="#25258E" />
                                <path class="group-hover:fill-white group-active:fill-white"
                                    d="M2.44531 9.26306C3.04284 8.90611 3.7414 8.62034 4.48872 8.39056C5.41068 8.10708 6.44691 7.89694 7.53413 7.74938C7.6817 6.66291 7.89177 5.6274 8.1751 4.70603C8.40521 3.95767 8.69148 3.25823 9.04915 2.66016C5.90137 3.63147 3.4172 6.1155 2.44531 9.26306Z"
                                    fill="#25258E" />
                                <path class="group-hover:fill-white group-active:fill-white"
                                    d="M14.9531 2.66016C15.3107 3.25818 15.5969 3.95753 15.8269 4.70578C16.1102 5.62728 16.3203 6.66294 16.4678 7.74957C17.5538 7.89711 18.5888 8.10711 19.5099 8.39029C20.2586 8.62051 20.9584 8.90693 21.5567 9.26484C20.5853 6.1166 18.1012 3.63187 14.9531 2.66016Z"
                                    fill="#25258E" />
                                <path class="group-hover:fill-white group-active:fill-white"
                                    d="M21.5573 15.168C20.9589 15.5261 20.259 15.8126 19.5101 16.0428C18.5891 16.326 17.554 16.536 16.4681 16.6836C16.3205 17.7704 16.1105 18.8062 15.8271 19.7279C15.597 20.4764 15.3108 21.176 14.9531 21.7742C18.1017 20.8024 20.5863 18.317 21.5573 15.168Z"
                                    fill="#25258E" />
                                <path class="group-hover:fill-white group-active:fill-white"
                                    d="M12.001 22.2153C12.4663 22.2144 12.8902 22.0036 13.2981 21.5202C13.7202 21.0198 14.0902 20.2619 14.3905 19.2851C14.6157 18.5523 14.7928 17.7267 14.926 16.8477C13.952 16.9277 12.9617 16.9641 11.9965 16.9641C11.0324 16.9641 10.0432 16.9277 9.07031 16.848C9.20356 17.7268 9.38062 18.5523 9.60591 19.2851C9.90622 20.2619 10.2762 21.0198 10.6984 21.5202C11.107 22.0046 11.5318 22.2153 11.9983 22.2153"
                                    fill="#25258E" />
                                <path class="group-hover:fill-white group-active:fill-white"
                                    d="M9.0459 21.7723C5.89755 20.8009 3.41303 18.3163 2.44141 15.168C3.03904 15.5251 3.73776 15.8109 4.48526 16.0407C5.40722 16.3242 6.44344 16.5344 7.53064 16.6819C7.67821 17.7686 7.88829 18.8043 8.17163 19.7258C8.40179 20.4744 8.68813 21.1741 9.0459 21.7723Z"
                                    fill="#25258E" />
                                <path class="group-hover:fill-white group-active:fill-white"
                                    d="M11.9964 7.46487C11.0324 7.46487 10.0432 7.50121 9.07031 7.58093C9.20355 6.70233 9.3806 5.87702 9.60586 5.14445C9.90617 4.16785 10.2761 3.41009 10.6983 2.9098C11.107 2.42551 11.5318 2.21484 11.9983 2.21484C12.4647 2.21484 12.8895 2.4255 13.2981 2.90978C13.7203 3.41007 14.0902 4.16782 14.3905 5.14442C14.6157 5.87708 14.7928 6.70249 14.926 7.58121C13.952 7.5013 12.9617 7.46487 11.9964 7.46487Z"
                                    fill="#25258E" />
                                <path class="group-hover:fill-white group-active:fill-white"
                                    d="M16.749 12.2166C16.749 11.252 16.7126 10.2623 16.6328 9.28906C17.5109 9.42226 18.3357 9.59922 19.0679 9.82435C20.0446 10.1246 20.8024 10.4945 21.3027 10.9167C21.787 11.3254 21.9977 11.7501 21.9977 12.2166C21.9977 12.6831 21.787 13.1078 21.3027 13.5165C20.8024 13.9387 20.0446 14.3086 19.0679 14.6089C18.3357 14.834 17.5109 15.011 16.6328 15.1442C16.7126 14.1708 16.749 13.1811 16.749 12.2166Z"
                                    fill="#25258E" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-zinc-700 font-semibold group-hover:text-white group-active:text-white">Open
                                in
                                Browser</p>
                            <p class="text-gray-400 text-[11px] group-hover:text-white group-active:text-white">Web
                                Platform
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Platform links end -->

    <!-- Features start -->
    <div class="mx-auto px-4 md:px-12 lg:px-72 mb-24 md:mb-54">
        <div class="mt-12 mb-6 text-center">
            <h2 class="text-accent font-normal text-xl md:text-3xl lg:text-4xl mb-8">Features</h2>
            <div class="mb-8 lg:mb-16 lg:flex lg:items-center">
                <div class="lg:flex-1">
                    <h3 class="text-accent font-normal text-md md:text-2xl lg:text-3xl lg:text-left mb-4">Analysis &
                        Alerts</h3>
                    <p class="text-sm md:text-base font-medium text-gray-600 leading-6 tracking-wide text-left">Get the
                        most out of
                        fundamental and
                        technical
                        analysis with our News Feed and Economic Calendars. More than 100 most widely used technical
                        indicators and widgets. Always stay up-to-date on what is happening in the financial markets
                        with
                        our customizable price alerts.</p>
                </div>
                <div class="lg:flex-1">
                    <img src="#" alt="">
                </div>
            </div>

            <div class="mb-8 lg:mb-16 lg:flex lg:items-center">
                <div class="lg:flex-1">
                    <img src="#" alt="">
                </div>
                <div class="lg:flex-1">
                    <h3 class="text-accent font-normal text-md md:text-2xl lg:text-3xl lg:text-left mb-4">Risk
                        Management</h3>
                    <p class="text-sm md:text-base font-medium text-gray-600 leading-6 tracking-wide text-left">With
                        features such as
                        Stop Loss/Take
                        Profit, Negative Balance Protection and Trailing Stop, you can manage your losses and profits at
                        the
                        levels you set.</p>
                </div>
            </div>

            <div class="mb-8 lg:mb-16 lg:flex lg:items-center">
                <div class="lg:flex-1">
                    <h3 class="text-accent font-normal text-md md:text-2xl lg:text-3xl lg:text-left mb-4">Trading
                        Community</h3>
                    <p class="text-sm md:text-base font-medium text-gray-600 leading-6 tracking-wide text-left">Join
                        the
                        massive IQ
                        Option community,
                        discuss trading ideas and opportunities, or simply follow other traders with features like
                        Trader
                        Sentiment and Community Live Trades.</p>
                </div>
                <div class="lg:flex-1">
                    <img src="#" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Features end -->

    <!-- Notice banner start -->
    <div class="mx-auto px-4 py-16 bg-accent md:px-12 lg:mb-16">
        <div>
            <h2
                class="text-white font-medium text-center text-xl md:text-3xl md:w-[38rem] md:mx-auto lg:w-full lg:text-4xl mb-4">
                Start risk-free with a
                Practice Trading Account</h2>
            <p
                class="text-sm mb-12 md:text-base font-normal text-white text-center md:text-start lg:text-center lg:mx-auto leading-6 lg:w-[46rem]">
                Why risk your money when you’re learning the ropes? Use your practice trading account to test your
                strategies and fine-tune your skills—no money lost, only experience gained!</p>
            <div class="text-center">
                <a href="{{ route('register') }}" wire:navigate
                    class="rounded-xs bg-accent-hover px-6 py-3.5 text-sm inline-block font-medium text-white shadow-xs hover:bg-accent-hover">Start
                    free trial <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <!-- Notice banner end -->

    <!-- Smart trading start -->
    <div class="mx-auto px-4 py-16 md:px-12 lg:px-64 lg:mb-16">
        <div>
            <h2
                class="text-accent font-medium text-center text-xl md:text-3xl md:w-[38rem] md:text-left lg:w-full lg:text-4xl mb-4">
                Smart trading, simplified</h2>
            <p
                class="text-sm mb-12 md:text-base font-normal text-zinc-700 text-center md:text-start leading-6 lg:w-[42rem]">
                Leverage powerful trading tools like multi-entry orders, trailing stops, and automated strategies.</p>

            <div class="rounded-lg border px-6 py-6 md:px-10 md:py-10 mb-4 grid grid-cols-1 lg:grid-cols-2 lg:gap-x-8">
                <div class="pb-12">
                    <h3 class="font-medium text-accent text-center md:text-left md:text-lg mb-2">Place multiple orders in one go</h3>
                    <p class="text-sm text-zinc-700 md:text-base">Create up to 10 entry orders and up to 10 take profits with a
                        couple of clicks, saving your valuable time.</p>
                </div>
                <div class="rounded-lg border p-4 px-6 h-48">

                </div>
            </div>

            <div class="rounded-lg border px-6 py-6 md:px-10 md:py-10 mb-4 grid grid-cols-1 lg:grid-cols-2 lg:gap-x-8">
                <div class="pb-12">
                    <h3 class="font-medium text-accent text-center md:text-left md:text-lg mb-2">No more spreadsheets or trading blind</h3>
                    <p class="text-sm text-zinc-700 md:text-base">Save time. Every time you trade, your PnL is automatically updated. Know exactly when you are in profit and when to sell.</p>
                </div>
                <div class="rounded-lg border p-4 px-6 h-48">

                </div>
            </div>

            <div class="rounded-lg border px-6 py-6 md:px-10 md:py-10 mb-4 grid grid-cols-1 lg:grid-cols-2 lg:gap-x-8">
                <div class="pb-12">
                    <h3 class="font-medium text-accent text-center md:text-left md:text-lg mb-2">Take emotion out of trading</h3>
                    <p class="text-sm text-zinc-700 md:text-base">Setup complete positions with entry, exits and stop losses in advance and avoid getting emotionally attached to the position and enjoy your day.</p>
                </div>
                <div class="rounded-lg border p-4 px-6 h-48">

                </div>
            </div>

            <div class="rounded-lg border px-6 py-6 md:px-10 md:py-10 mb-4 grid grid-cols-1 lg:grid-cols-2 lg:gap-x-8">
                <div class="pb-12">
                    <h3 class="font-medium text-accent text-center md:text-left md:text-lg mb-2">Never lose on a winning trade</h3>
                    <p class="text-sm text-zinc-700 md:text-base">Protect your profits by automatically moving stop loss to break even price.</p>
                </div>
                <div class="rounded-lg border p-4 px-6 h-48">

                </div>
            </div>

            <div class="rounded-lg border px-6 py-6 md:px-10 md:py-10 mb-12 grid grid-cols-1 lg:grid-cols-2 lg:gap-x-8">
                <div class="pb-12">
                    <h3 class="font-medium text-accent text-center md:text-left md:text-lg mb-2">Manage risks easily</h3>
                    <p class="text-sm text-zinc-700 md:text-base">Risk to reward ratio is in your trading form. Risk-based position size is there as well. No more excuses to not follow your risk management rules.</p>
                </div>
                <div class="rounded-lg border p-4 px-6 h-48">

                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('register') }}" wire:navigate
                    class="rounded-xs bg-accent-hover px-6 py-3.5 text-sm inline-block font-medium text-white shadow-xs hover:bg-accent-hover">Start
                    Free Trial Now <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <!-- Smart trading end -->

    <!-- Steps start -->
    <div class="mx-auto px-4 md:px-12 md:mb-24">
        <div class="mt-12 mb-6 md:mb-12 text-center">
            <h2 class="text-accent font-normal text-xl md:text-3xl">Start Trading in 3 Steps</h2>
        </div>
        <div class="lg:flex lg:items-center lg:justify-around lg:mx-auto lg:px-36">
            <div class="flex items-start space-x-3 mb-6 lg:flex-col">
                <div class="flex-none w-20 lg:mb-6 lg:flex-1 lg:w-full lg:text-center">
                    <img class="lg:inline" src="{{ asset('assets/icons/clipboard.svg') }}" alt=""
                        srcset="">
                </div>
                <div class="flex-1 lg:text-center">
                    <h3 class="text-accent font-semibold text-md mb-2">1. Registration</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 leading-6 lg:w-72 lg:mx-auto">Open an account for
                        free in just a few
                        minutes</p>
                </div>
            </div>

            <div class="flex items-start space-x-3 mb-6 lg:flex-col">
                <div class="flex-none w-20 lg:mb-6 lg:flex-1 lg:w-full lg:text-center">
                    <img class="lg:inline" src="{{ asset('assets/icons/graduation-cap.svg') }}" alt=""
                        srcset="">
                </div>
                <div class="flex-1 lg:text-center">
                    <h3 class="text-accent font-semibold text-md mb-2">Practice</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 leading-6 lg:w-72 lg:mx-auto">Master your skills
                        with a practice
                        account and educational content</p>
                </div>
            </div>

            <div class="flex items-start space-x-3 lg:flex-col lg:mb-6">
                <div class="flex-none w-20 lg:mb-6 lg:flex-1 lg:w-full lg:text-center">
                    <img class="lg:inline" src="{{ asset('assets/icons/candlesticks.svg') }}" alt=""
                        srcset="">
                </div>
                <div class="flex-1 lg:text-center">
                    <h3 class="text-accent font-semibold text-md mb-2">Deposit & Trade</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 leading-6 lg:w-72 lg:mx-auto">More than 250
                        instruments and a minimum
                        deposit of $100 for optimal trading</p>
                </div>
            </div>
        </div>
        <div class="mt-6 text-center lg:hidden">
            <a href="{{ route('register') }}" wire:navigate
                class="rounded-xs bg-accent px-6 py-3.5 text-sm inline-block font-medium text-white shadow-xs hover:bg-accent-hover">Open
                account</a>
        </div>
    </div>
    <!-- Steps end -->

    <!-- Extra information start -->
    <div class="mx-auto px-4 md:px-12 lg:px-72 mb-3 border-b border-gray-300 pb-4">
        <div class="mt-12 mb-6">
            <h2 class="text-accent font-normal text-xl md:text-3xl mb-2 text-center">Online Trading Platform</h2>
            <div class="mb-10 lg:mb-16">
                <h3 class="text-gray-600 font-medium text-md mb-5 lg:mb-14 text-center">CFDs on Stocks, ETFs,
                    Commodities,
                    Indices,
                    Cryptocurrencies and Forex</h3>
                <p class="text-sm font-medium text-gray-600 leading-6 text-left mb-4">
                    IQ Option is one of the fastest growing online trading brands in the world. Voted the best mobile
                    trading platform, we have now expanded our offerings to include CFDs on stocks, ETFs and Forex
                    trading.
                </p>
                <p class="text-sm font-medium text-gray-600 leading-6 text-left mb-4">
                    First founded in 2013, IQ Option has grown massively and now has over 40 million members and
                    counting! The platform itself has also undergone some changes since 2013, and we are constantly
                    working to ensure it is fast, accurate, and easy to use.
                </p>
                <p class="text-sm font-medium text-gray-600 leading-6 text-left mb-4">
                    We have also refined our offering and introduced plenty of new products in our bid to continue
                    giving our customers the ultimate online trading experience and to help them optimize their
                    investment portfolio. Now, using our platform, our members can try CFDs on currency pairs, CFDs on
                    stocks, CFDs on commodities, CFDs on cryptocurrencies, as well as CFDs on ETFs.
                </p>
            </div>

            <div class="lg:grid lg:grid-cols-2 lg:gap-6">
                <div class="lg:flex-1 flex items-start space-x-3 mb-6">
                    <div class="flex-none w-20">
                        <img src="{{ asset('assets/icons/forex-coins.svg') }}" alt="" srcset="">
                    </div>
                    <div class="flex-1">
                        <h3 class="text-accent font-semibold text-md mb-2">Forex</h3>
                        <p class="text-zinc-700 text-sm font-medium tracking-wide leading-6">Explore and trade major,
                            minor and exotic currency pairs with efficient spreads.</p>
                        <a href="{{ route('register') }}" wire:navigate class="text-accent text-sm font-medium">Learn More</a>
                    </div>
                </div>
                <div class="lg:flex-1 flex items-start space-x-3 mb-6">
                    <div class="flex-none w-20">
                        <img src="{{ asset('assets/icons/crypto-coins.svg') }}" alt="" srcset="">
                    </div>
                    <div class="flex-1">
                        <h3 class="text-accent font-semibold text-md mb-2">Cryptocurrencies</h3>
                        <p class="text-zinc-700 text-sm font-medium tracking-wide leading-6">Trade CFDs on popular
                            digital currencies with leverage.</p>
                        <a href="{{ route('register') }}" wire:navigate class="text-accent text-sm font-medium">Learn More</a>
                    </div>
                </div>
                <div class="lg:flex-1 flex items-start space-x-3">
                    <div class="flex-none w-20">
                        <img src="{{ asset('assets/icons/institution.svg') }}" alt="" srcset="">
                    </div>
                    <div class="flex-1">
                        <h3 class="text-accent font-semibold text-md mb-2">Stocks</h3>
                        <p class="text-zinc-700 text-sm font-medium tracking-wide leading-6">Trade CFDs on stocks of
                            leading companies and industry giants without actually owning them.</p>
                        <a href="{{ route('register') }}" wire:navigate class="text-accent text-sm font-medium">Learn More</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Extra information end -->

</div>

@script
    <script>
        $wire.on('fetch-market-data-error', (event) => {
            const toastMarkup = `
                <div class="flex p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-gray-700 dark:text-neutral-400">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 fixed -top-37.5 right-5 z-90 transition-all duration-300 w-80 bg-white text-sm text-gray-700 border border-gray-200 rounded-xl shadow-lg [&>.toast-close]:hidden dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript
