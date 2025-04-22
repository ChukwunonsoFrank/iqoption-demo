<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/7016607b5a.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body>

    <div class="min-h-full relative">
        <nav x-data="{ isMobileMenuOpen: false }" class="bg-white fixed w-full top-0 z-10">
            <div class="mx-auto px-4">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0 flex items-center space-x-2">
                            <!-- Mobile menu button -->
                            <button class="md:hidden" type="button" x-on:click="isMobileMenuOpen = !isMobileMenuOpen"
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
                            <img class="size-8"
                                src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                                alt="Your Company">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="#" class="rounded-md px-3 py-2 text-md font-medium text-zinc-700"
                                    aria-current="page">Stocks</a>
                                <a href="#" class="rounded-md px-3 py-2 text-md font-medium text-zinc-700">For
                                    Traders</a>
                                <a href="#" class="rounded-md px-3 py-2 text-md font-medium text-zinc-700">About
                                    Us</a>
                                <a href="#" class="rounded-md px-3 py-2 text-md font-medium text-zinc-700">VIP</a>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex space-x-2 items-center md:ml-6">
                            <a href="#"
                                class="rounded-xs border border-accent px-3.5 py-2.5 text-sm font-medium text-accent shadow-xs hover:bg-accent hover:text-white">Log
                                In</a>
                            <a href="#"
                                class="rounded-xs bg-accent px-3.5 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-accent-hover">Sign
                                Up</a>
                        </div>
                    </div>
                    <div class="flex space-x-3 md:hidden">
                        <div class="border border-accent rounded-full p-2">
                            <!--  Auth button -->
                            <div>
                                <img src="{{ asset('assets/icons/auth.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div x-show="isMobileMenuOpen" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95" class="md:hidden h-screen" id="mobile-menu">
                <div class="space-y-1 px-4 pt-2 pb-3 sm:px-3">
                    <a href="#" class="block py-4 text-xs font-bold border-b-1 text-zinc-700"
                        aria-current="page">STOCKS</a>
                    <a href="#" class="block py-4 text-xs font-bold border-b-1 text-zinc-700">FOR TRADERS</a>
                    <a href="#" class="block py-4 text-xs font-bold border-b-1 text-zinc-700">ABOUT US</a>
                    <a href="#" class="block py-4 text-xs font-bold text-zinc-700">VIP</a>
                </div>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>
