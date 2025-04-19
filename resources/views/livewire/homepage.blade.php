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
                                    class="rounded-xs border border-accent w-24 px-1 pt-1 pb-0 text-center inline-block text-accent hover:bg-accent-hover hover:text-white active:bg-accent-hover active:text-white">
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
    <div>
        <div class="mt-12 mb-6 text-center">
            <h2 class="text-accent font-medium text-xl mb-2">Deposits & Withdrawals</h2>
            <p class="text-sm font-medium text-gray-600 leading-6 w-80 mx-auto">Choose between multiple payment systems
                to withdraw
                and
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
                                <img src="{{ asset('assets/icons/wire-transfer.svg') }}" alt=""
                                    srcset="">
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
                class="rounded-xs bg-accent px-6 py-3.5 text-sm inline-block font-medium text-white shadow-xs hover:bg-accent-hover">Open
                account</a>
        </div>
    </div>
    <!-- Payment methods slider end -->

    <!-- Plaform features start -->
    <div class="mt-20 mb-6 mx-auto px-4">
        <div>
            <div class="flex items-center space-x-3 mb-6">
                <div class="flex-none w-20">
                    <img src="{{ asset('assets/icons/features-devices.svg') }}" alt="" srcset="">
                </div>
                <div class="flex-1">
                    <h3 class="text-zinc-700 font-bold text-md mb-2">Advanced Platform</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 tracking-wide">Web & Mobile</p>
                    <a href="#" class="text-accent text-sm font-medium">Download App</a>
                </div>
            </div>
            <div class="flex items-center space-x-3 mb-6">
                <div class="flex-none w-20">
                    <img src="{{ asset('assets/icons/features-graduation-cap.svg') }}" alt=""
                        srcset="">
                </div>
                <div class="flex-1">
                    <h3 class="text-zinc-700 font-bold text-md mb-2">Free Practice</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 tracking-wide">Refillable free Practice Account of
                        $10,000</p>
                    <a href="#" class="text-accent text-sm font-medium">Try Practice Account</a>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="flex-none w-20">
                    <img src="{{ asset('assets/icons/features-headphones.svg') }}" alt="" srcset="">
                </div>
                <div class="flex-1">
                    <h3 class="text-zinc-700 font-bold text-md mb-2">Customer Service</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 tracking-wide">Prompt multilingual support</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Plaform features end -->

    <!-- Platform links start -->
    <div class="mx-auto px-4">
        <div class="mt-12 mb-6 text-center">
            <h2 class="text-accent font-medium text-xl mb-4">Enjoy the ease of access</h2>
            <p class="text-sm font-medium text-gray-600 leading-6">A multichart layout, technical analysis, historical
                quotes and beyond. Everything you're looking for in a platform — on the device of your choice.</p>
        </div>
        <div>
            <div
                class="flex group items-center space-x-3 mx-auto rounded-sm bg-white border border-accent p-1.5 mb-3 w-48 text-sm font-medium shadow-xs hover:bg-accent active:bg-accent">
                <div>
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path class="group-hover:fill-white group-active:fill-white"
                            d="M16.6025 14.7823C16.4378 14.7823 16.2768 14.7335 16.1398 14.642C16.0028 14.5505 15.896 14.4205 15.833 14.2683C15.7699 14.1161 15.7534 13.9487 15.7855 13.7871C15.8176 13.6255 15.8969 13.4771 16.0133 13.3606C16.1298 13.2441 16.2782 13.1648 16.4397 13.1326C16.6013 13.1004 16.7688 13.1169 16.921 13.1799C17.0732 13.2429 17.2033 13.3496 17.2948 13.4866C17.3863 13.6235 17.4352 13.7845 17.4352 13.9493C17.435 14.1701 17.3472 14.3818 17.1911 14.5379C17.035 14.6941 16.8233 14.782 16.6025 14.7823ZM7.39745 14.7823C7.23272 14.7823 7.07168 14.7335 6.9347 14.642C6.79771 14.5505 6.69094 14.4205 6.62787 14.2683C6.5648 14.1161 6.54828 13.9487 6.58039 13.7871C6.61249 13.6255 6.69179 13.4771 6.80825 13.3606C6.9247 13.2441 7.07309 13.1648 7.23465 13.1326C7.3962 13.1004 7.56367 13.1169 7.71587 13.1799C7.86807 13.2429 7.99817 13.3496 8.08971 13.4866C8.18126 13.6235 8.23013 13.7845 8.23016 13.9493C8.22996 14.1701 8.14217 14.3818 7.98606 14.538C7.82994 14.6941 7.61826 14.782 7.39745 14.7823ZM16.9012 9.7658L18.5655 6.88314C18.5883 6.84377 18.6031 6.80029 18.609 6.75521C18.615 6.71012 18.612 6.6643 18.6003 6.62036C18.5885 6.57642 18.5682 6.53523 18.5406 6.49913C18.5129 6.46303 18.4784 6.43273 18.439 6.40997C18.3997 6.38721 18.3562 6.37242 18.3111 6.36646C18.266 6.3605 18.2202 6.36347 18.1762 6.37522C18.1323 6.38697 18.0911 6.40725 18.055 6.43492C18.0189 6.46258 17.9886 6.49709 17.9659 6.53646L16.2805 9.45553C14.9917 8.86732 13.5443 8.53979 11.9998 8.53979C10.4554 8.53979 9.00811 8.86779 7.71933 9.45553L6.03412 6.53646C6.01138 6.49708 5.98112 6.46256 5.94504 6.43487C5.90897 6.40718 5.86779 6.38687 5.82387 6.37509C5.77995 6.36332 5.73413 6.36031 5.68905 6.36624C5.64396 6.37217 5.60049 6.38692 5.5611 6.40966C5.52172 6.43239 5.48719 6.46266 5.45951 6.49873C5.43182 6.5348 5.41151 6.57598 5.39973 6.6199C5.38796 6.66382 5.38495 6.70964 5.39088 6.75472C5.39681 6.79981 5.41156 6.84329 5.43429 6.88267L7.09879 9.7658C4.24077 11.3202 2.28594 14.2136 2 17.632H22C21.7137 14.2136 19.759 11.3202 16.9012 9.7658Z"
                            fill="#25258E" />
                    </svg>

                </div>
                <div>
                    <p class="text-zinc-700 group-hover:text-white group-active:text-white font-semibold">For Mobile</p>
                    <p class="text-gray-400 group-hover:text-white group-active:text-white text-[11px]">.apk 21.5 Mb</p>
                </div>
            </div>

            <div
                class="flex group items-center space-x-3 mx-auto rounded-sm bg-white border border-accent p-1.5 w-48 text-sm font-medium shadow-xs hover:bg-accent active:bg-accent">
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
                    <p class="text-zinc-700 font-semibold group-hover:text-white group-active:text-white">Open in Browser</p>
                    <p class="text-gray-400 text-[11px] group-hover:text-white group-active:text-white">Web Platform</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Platform links end -->

    <!-- Features start -->
    <div class="mx-auto px-4 mb-24">
        <div class="mt-12 mb-6 text-center">
            <h2 class="text-accent font-medium text-xl mb-10">Features</h2>
            <div class="mb-8">
                <h3 class="text-accent font-normal text-md mb-4">Analysis & Alerts</h3>
                <p class="text-sm font-medium text-gray-600 leading-6 tracking-wide text-left">Get the most out of fundamental and
                    technical
                    analysis with our News Feed and Economic Calendars. More than 100 most widely used technical
                    indicators and widgets. Always stay up-to-date on what is happening in the financial markets with
                    our customizable price alerts.</p>
                <div></div>
            </div>

            <div class="mb-8">
                <h3 class="text-accent font-normal text-md mb-4">Risk Management</h3>
                <p class="text-sm font-medium text-gray-600 leading-6 tracking-wide text-left">With features such as Stop Loss/Take
                    Profit, Negative Balance Protection and Trailing Stop, you can manage your losses and profits at the
                    levels you set.</p>
                <div></div>
            </div>

            <div>
                <h3 class="text-accent font-normal text-md mb-4">Trading Community</h3>
                <p class="text-sm font-medium text-gray-600 leading-6 tracking-wide text-left">Join the massive IQ Option community,
                    discuss trading ideas and opportunities, or simply follow other traders with features like Trader
                    Sentiment and Community Live Trades.</p>
                <div></div>
            </div>
        </div>
    </div>
    <!-- Features end -->

    <!-- Steps start -->
    <div class="mx-auto px-4">
        <div class="mt-12 mb-6 text-center">
            <h2 class="text-accent font-medium text-xl">Start Trading in 3 Steps</h2>
        </div>
        <div>
            <div class="flex items-center space-x-3 mb-6">
                <div class="flex-none w-20">
                    <img src="{{ asset('assets/icons/features-devices.svg') }}" alt="" srcset="">
                </div>
                <div class="flex-1">
                    <h3 class="text-accent font-semibold text-md mb-2">Registration</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 leading-6">Open an account for free in just a few minutes</p>
                </div>
            </div>
            <div class="flex items-center space-x-3 mb-6">
                <div class="flex-none w-20">
                    <img src="{{ asset('assets/icons/features-graduation-cap.svg') }}" alt=""
                        srcset="">
                </div>
                <div class="flex-1">
                    <h3 class="text-accent font-semibold text-md mb-2">Practice</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 leading-6">Master your skills with a practice account and educational content</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="flex-none w-20">
                    <img src="{{ asset('assets/icons/features-headphones.svg') }}" alt="" srcset="">
                </div>
                <div class="flex-1">
                    <h3 class="text-accent font-semibold text-md mb-2">Deposit & Trade</h3>
                    <p class="text-zinc-700 text-sm font-medium mb-2 leading-6">More than 250 instruments and a minimum deposit of $100 for optimal trading</p>
                </div>
            </div>
        </div>
        <div class="mt-6 text-center">
            <a href="#"
                class="rounded-xs bg-accent px-6 py-3.5 text-sm inline-block font-medium text-white shadow-xs hover:bg-accent-hover">Open
                account</a>
        </div>
    </div>
    <!-- Steps end -->
</div>
