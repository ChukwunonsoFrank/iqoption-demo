<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bullfex - AI Trading Robot</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/7016607b5a.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/qrcode.min.js') }}"></script>

    @livewireStyles
    @vite('resources/css/app.css')

    <style>
        [x-cloak] {
            display: none !important;
        }

        #qrcode canvas {
            width: 100% !important;
        }

        #qrcode img {
            width: 100% !important;
        }
    </style>
</head>

<body class="bg-dashboard font-dashboard">
    <main class="flex flex-col h-svh space-y-4">
        <header class="pt-4 mb-4 px-4 flex-none lg:pb-4 lg:mb-0 lg:border-b-[0.1px] lg:border-gray-700">
            <div class="md:flex md:items-center md:justify-between md:gap-x-20 lg:gap-x-[48rem]">
                <div class="flex items-center justify-between space-x-8 mb-4 md:mb-0 md:order-2 md:flex-1">
                    <div class="flex-1">
                        <p class="text-zinc-300 text-[10px] mb-1 md:uppercase">Demo account</p>
                        <p class="text-white font-semibold text-xs md:text-sm">@money(auth()->user()->demo_balance / 100)</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-zinc-300 text-[10px] mb-1 md:uppercase">Live account</p>
                        <p class="text-white font-semibold text-xs md:text-sm">@money(auth()->user()->live_balance / 100)</p>
                    </div>
                    <div class="flex-1 text-end">
                        <a href="{{ route('dashboard.deposit') }}">
                            <button type="button"
                                class="py-2 px-4 md:px-6 md:py-3 inline-flex items-center gap-x-2 text-sm md:text-base font-semibold rounded-sm bg-accent text-white focus:outline-hidden">
                                <i class="fas fa-credit-card"></i>
                                Deposit
                            </button>
                        </a>
                    </div>
                </div>
                <livewire:dashboard.partials.asset-indicator />
            </div>
        </header>

        <div class="grow lg:mb-0 overflow-scroll lg:overflow-hidden">
            {{ $slot }}
        </div>

        <livewire:dashboard.partials.mobile-navbar />
    </main>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ asset('assets/js/clipboard.min.js') }}"></script>
    @livewireScripts
</body>

</html>
