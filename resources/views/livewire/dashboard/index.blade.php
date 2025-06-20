<div class="px-4 lg:px-0 h-full">
    <div class="md:hidden h-full">
        <div class="tradingview-widget-container mb-2">
            <div class="tradingview-widget-container__widget" style="height:100%;width:100%"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                {
                    "autosize": true,
                    "symbol": "{{ $this->activeBotTickerSymbol }}",
                    "interval": "{{ $this->chartDuration }}",
                    "timezone": "Etc/UTC",
                    "theme": "dark",
                    "style": "3",
                    "locale": "en",
                    "allow_symbol_change": true,
                    "backgroundColor": "rgba(29, 31, 38, 1)",
                    "calendar": false,
                    "hide_top_toolbar": true,
                    "hide_volume": true,
                    "support_host": "https://www.tradingview.com"
                }
            </script>
        </div>
    </div>

    <div class="hidden md:block lg:hidden h-full">
        <div class="tradingview-widget-container mb-2">
            <div class="tradingview-widget-container__widget" style="height:100%;width:100%"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                {
                    "autosize": true,
                    "symbol": "{{ $this->activeBotTickerSymbol }}",
                    "interval": "{{ $this->chartDuration }}",
                    "timezone": "Etc/UTC",
                    "theme": "dark",
                    "style": "3",
                    "locale": "en",
                    "allow_symbol_change": true,
                    "backgroundColor": "rgba(29, 31, 38, 1)",
                    "calendar": false,
                    "hide_top_toolbar": true,
                    "hide_volume": true,
                    "support_host": "https://www.tradingview.com"
                }
            </script>
        </div>
    </div>

    <div class="hidden lg:flex h-full">
        <livewire:dashboard.partials.desktop-navbar />

        <div class="h-full flex-1 lg:pr-4">
            <div class="tradingview-widget-container mb-2">
                <div class="tradingview-widget-container__widget" style="height:100%;width:100%"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                        "autosize": true,
                        "symbol": "{{ $this->activeBotTickerSymbol }}",
                        "interval": "{{ $this->chartDuration }}",
                        "timezone": "Etc/UTC",
                        "theme": "dark",
                        "style": "3",
                        "locale": "en",
                        "allow_symbol_change": true,
                        "backgroundColor": "rgba(29, 31, 38, 1)",
                        "calendar": false,
                        "hide_top_toolbar": true,
                        "hide_volume": true,
                        "support_host": "https://www.tradingview.com"
                    }
                </script>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('message', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
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

