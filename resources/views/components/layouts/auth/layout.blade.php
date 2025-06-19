<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bullfex - AI Trading Robot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/7016607b5a.js" crossorigin="anonymous"></script>
    <script async src="https://www.google.com/recaptcha/api.js"></script>
    @livewireStyles
    @vite('resources/css/app.css')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>

    <div class="min-h-full relative">
        <nav x-data="{ isMobileMenuOpen: false }" class="bg-white fixed w-full top-0 z-10">
            <div class="mx-auto px-4 lg:px-6">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0 flex items-center space-x-2">
                            <!-- Mobile menu button -->
                            <button class="lg:hidden" type="button" x-on:click="isMobileMenuOpen = !isMobileMenuOpen"
                                class="relative inline-flex items-center justify-center" aria-controls="mobile-menu"
                                aria-expanded="false">
                                {{-- <span class="absolute -inset-0.5"></span> --}}
                                <span class="sr-only">Open main menu</span>
                                <!-- Menu open: "hidden", Menu closed: "block" -->
                                <svg class="block size-6"
                                    :class="{ 'hidden': isMobileMenuOpen, 'block': !isMobileMenuOpen }" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <!-- Menu open: "block", Menu closed: "hidden" -->
                                <svg class="hidden size-6"
                                    :class="{ 'block': isMobileMenuOpen, 'hidden': !isMobileMenuOpen }" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                    data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <a href="{{ route('home') }}" wire:navigate>
                                <img class="size-8"
                                    src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                                    alt="Your Company">
                            </a>
                        </div>
                        <div class="hidden lg:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="{{ route('about') }}" wire:navigate
                                    class="rounded-md px-3 py-2 text-md font-medium text-zinc-700"
                                    aria-current="page">About Us</a>
                                <a href="{{ route('terms') }}" wire:navigate
                                    class="rounded-md px-3 py-2 text-md font-medium text-zinc-700">Terms</a>
                                <a href="{{ route('privacy') }}" wire:navigate
                                    class="rounded-md px-3 py-2 text-md font-medium text-zinc-700">Privacy</a>
                            </div>
                        </div>
                    </div>
                    <div class="hidden lg:block">
                        <div class="ml-4 flex space-x-2 items-center md:ml-6">
                            <a href="{{ route('login') }}"
                                class="rounded-xs border border-accent px-3.5 py-2.5 text-sm font-medium text-accent shadow-xs hover:bg-accent hover:text-white">Log
                                In</a>
                            <a href="{{ route('register') }}"
                                class="rounded-xs bg-accent px-3.5 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-accent-hover">Sign
                                Up</a>
                        </div>
                    </div>
                    <div class="flex space-x-3 lg:hidden">
                        <a href="{{ route('login') }}">
                            <div class="border border-accent rounded-full p-2">
                                <!--  Auth button -->
                                <div>
                                    <img src="{{ asset('assets/icons/auth.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div x-cloak x-show="isMobileMenuOpen" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95" class="lg:hidden h-screen" id="mobile-menu">
                <div class="space-y-1 px-4 pt-2 pb-3 sm:px-3">
                    <a href="{{ route('about') }}" class="block py-4 text-xs font-bold border-b-1 text-zinc-700">ABOUT
                        US</a>
                    <a href="{{ route('terms') }}" class="block py-4 text-xs font-bold border-b-1 text-zinc-700"
                        aria-current="page">TERMS</a>
                    <a href="{{ route('privacy') }}"
                        class="block py-4 text-xs font-bold border-b-1 text-zinc-700">PRIVACY</a>
                </div>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>

        <!-- Scroll to top start -->
        <div class="mx-auto px-4 md:px-12 lg:px-72 pb-3 mb-6 border-b border-gray-100">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-xs text-gray-400 font-medium">Home @if ($title !== 'Home')
                            <i class="fas fa-caret-right text-accent fa-xs"></i> {{ $title }}
                        @endif
                    </p>
                </div>
                <div class="flex-none">
                    <div class="flex space-x-3 items-center hover:cursor-pointer"
                        onclick="window.scrollTo({ top: 0, behavior: 'smooth' });">
                        <div>
                            <span class="text-sm font-medium text-accent hidden md:block">Scroll to Top</span>
                        </div>
                        <div class="border border-accent rounded-full p-2">
                            <div>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 15L12 8L19 15" stroke="#25258E" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scroll to top end -->

        <!-- Footer start -->
        <footer class="lg:flex lg:items-start lg:px-72">
            <div
                class="mx-auto px-4 md:px-12 border-b border-gray-100 md:border-b-0 pb-6 mb-8 md:mb-0 lg:flex-1 lg:flex lg:items-start lg:px-0">
                <div class="text-center mb-12 lg:flex-none lg:text-start lg:w-40">
                    <a href="{{ route('about') }}">
                        <p class="font-medium text-gray-400 text-sm mb-3">About</p>
                    </a>
                    <a href="{{ route('terms') }}">
                        <p class="font-medium text-gray-400 text-sm mb-3">Terms & Conditions</p>
                    </a>
                    <a href="{{ route('privacy') }}">
                        <p class="font-medium text-gray-400 text-sm">Privacy Policy</p>
                    </a>
                </div>
                <div class="lg:flex-1">
                    <div class="relative border border-gray-400 p-4 rounded-xs mb-4">
                        <div class="absolute -top-2 bg-white px-2">
                            <h5 class="text-zinc-700 font-bold text-xs">RISK WARNING:</h5>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-medium leading-[17px]">
                                The Financial Products offered by the company include Contracts for Difference ('CFDs')
                                and
                                other complex financial products. Trading CFDs carries a high level of risk, since
                                leverage can
                                work both to your advantage and disadvantage. As a result, CFDs may not be suitable for
                                all
                                investors because it is possible to lose all of your invested capital. You should never
                                invest
                                money that you cannot afford to lose. Before trading in the complex financial products
                                offered,
                                please ensure to understand the risks involved.
                            </p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-xs font-medium leading-[17px]">
                        You are granted limited non-exclusive non-transferable rights to use the IP provided on this
                        website for
                        personal and non-commercial purposes in relation to the services offered on the Website only.
                    </p>
                </div>
            </div>

            <div class="mx-auto px-4 md:px-12 lg:flex-none lg:w-56 lg:px-4">
                <div>
                    <div class="relative border border-gray-400 p-4 rounded-xs mb-4">
                        <div class="absolute -top-2 bg-white px-2">
                            <h5 class="text-zinc-700 font-bold text-xs">DOWNLOAD APP</h5>
                        </div>
                        <div>
                            <div>
                                <img class="size-5 inline"
                                    src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                                    alt="Your Company">
                                <span class="inline text-black font-semibold text-xs"> Company Name</span>
                            </div>
                            <div class="mb-1">
                                <span class="text-[10px] text-zinc-700">Full version, 21.5MB</span>
                            </div>
                            <div>
                                <div class="flex items-center justify-center rounded-sm bg-black p-1.5 w-full">
                                    <div>
                                        <img class="w-28"
                                            src="{{ asset('assets/icons/get-it-on-playstore.svg') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <div class="mx-auto px-4 md:px-12 mb-4 text-center">
            <div></div>
            <div>
                <p class="text-zinc-700 text-xs font-medium">Company Name, © 2013-2025</p>
            </div>
        </div>
        <!-- Footer end -->
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @livewireScripts
</body>

</html>
