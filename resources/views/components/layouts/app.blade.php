<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/7016607b5a.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/qrcode.min.js') }}"></script>
    <script src="{{ asset('assets/js/clipboard.min.js') }}"></script>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

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
                        <p class="text-white font-semibold text-xs md:text-sm">$1,002.90</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-zinc-300 text-[10px] mb-1 md:uppercase">Real account</p>
                        <p class="text-white font-semibold text-xs md:text-sm">$2,309.98</p>
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
                <div
                    class="bg-asset-indicator rounded-sm flex space-x-2 p-2 items-center md:order-1 md:flex-none md:w-1/3 lg:w-1/6">
                    <div>
                        <img src="https://olympmatix.com/icons/assets/BITCOIN.svg" alt="">
                    </div>
                    <div>
                        <p class="text-white text-[12px] font-semibold">Bitcoin</p>
                        <p class="text-zinc-300 text-[9px] md:text-[10px]">Crypto</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="grow lg:mb-0 overflow-scroll lg:overflow-hidden">
            {{ $slot }}
        </div>

        <nav id="mobile__navbar" class="flex-none lg:hidden px-4 w-full pb-4">
            <div class="flex justify-between items-center md:justify-around">
                <a class="block" href="{{ route('dashboard') }}">
                    <div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#D4D4D4" stroke-width="{{ request()->is('dashboard') ? 2 : 1 }}"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-chart-candlestick-icon lucide-chart-candlestick">
                                <path d="M9 5v4" />
                                <rect width="4" height="6" x="7" y="9" rx="1" />
                                <path d="M9 15v2" />
                                <path d="M17 3v2" />
                                <rect width="4" height="8" x="15" y="5" rx="1" />
                                <path d="M17 13v3" />
                                <path d="M3 3v16a2 2 0 0 0 2 2h16" />
                            </svg>
                        </div>
                    </div>
                </a>
                <a class="block" href="{{ route('dashboard.history') }}">
                    <div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#D4D4D4"
                                stroke-width="{{ request()->is('dashboard/history') ? 2 : 1 }}" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-briefcase-icon lucide-briefcase">
                                <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                                <rect width="20" height="14" x="2" y="6" rx="2" />
                            </svg>
                        </div>
                    </div>
                </a>
                <a class="block" href="{{ route('dashboard.robot') }}">
                    <div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#D4D4D4"
                                stroke-width="{{ request()->is('dashboard/robot') ? 2 : 1 }}" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-bot-icon lucide-bot">
                                <path d="M12 8V4H8" />
                                <rect width="16" height="12" x="4" y="8" rx="2" />
                                <path d="M2 14h2" />
                                <path d="M20 14h2" />
                                <path d="M15 13v2" />
                                <path d="M9 13v2" />
                            </svg>
                        </div>
                    </div>
                </a>
                <div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="#D4D4D4" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-message-square-icon lucide-message-square">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                    </div>
                </div>
                <a class="block" href="{{ route('dashboard.account') }}">
                    <div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#D4D4D4"
                                stroke-width="{{ request()->is('dashboard/account') ? 2 : 1 }}"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-user-icon lucide-user">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </nav>
    </main>

</body>

</html>
