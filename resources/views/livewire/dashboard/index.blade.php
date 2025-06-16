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
