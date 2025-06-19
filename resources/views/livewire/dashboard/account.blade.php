<div class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-80 lg:pt-6">
            <div class="mb-3 sticky top-0 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Account</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll scrollbar-hide">
                <div class="lg:flex lg:items-start lg:space-x-4">
                    <div class="flex justify-center mb-3 lg:justify-start">
                        <div class="bg-trade size-16 rounded-full flex items-center justify-center lg:size-20">
                            <svg class="lg:hidden" xmlns="http://www.w3.org/2000/svg" width="44" height="44"
                                viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-circle-user-icon lucide-circle-user">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="10" r="3" />
                                <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                            </svg>
                            <svg class="hidden lg:inline" xmlns="http://www.w3.org/2000/svg" width="48"
                                height="48" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-circle-user-icon lucide-circle-user">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="10" r="3" />
                                <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-center mb-8 lg:text-start">
                        <h1 class="text-white text-base font-semibold">{{ auth()->user()->name }}</h1>
                        <span class="text-xs text-white">{{ auth()->user()->email }}</span>
                        <div class="mt-3">
                            <a href="{{ route('dashboard.withdraw') }}">
                                <button type="button"
                                    class="py-2 px-4 md:px-6 md:py-3 inline-flex items-center gap-x-2 text-sm md:text-base font-semibold rounded-sm bg-accent text-white focus:outline-hidden">
                                    <i class="fa-solid fa-money-bill-transfer"></i>
                                    Withdraw
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="lg:grid lg:grid-cols-2 lg:gap-4">
                    <a href="{{ route('dashboard.deposithistory') }}">
                        <div class="bg-trade w-full rounded-sm flex flex-col space-y-2 p-3 mb-3 lg:mb-0">
                            <div class="flex items-center space-x-2">
                                <div class="flex-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                        viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-banknote-arrow-down-icon lucide-banknote-arrow-down">
                                        <path d="M12 18H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5" />
                                        <path d="m16 19 3 3 3-3" />
                                        <path d="M18 12h.01" />
                                        <path d="M19 16v6" />
                                        <path d="M6 12h.01" />
                                        <circle cx="12" cy="12" r="2" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-sm text-white">Deposit History</p>
                                </div>
                                <div class="flex-none text-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('dashboard.withdrawhistory') }}">
                        <div class="bg-trade w-full rounded-sm flex flex-col space-y-2 p-3 mb-3 lg:mb-0">
                            <div class="flex items-center space-x-2">
                                <div class="flex-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                        viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-banknote-arrow-up-icon lucide-banknote-arrow-up">
                                        <path d="M12 18H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5" />
                                        <path d="M18 12h.01" />
                                        <path d="M19 22v-6" />
                                        <path d="m22 19-3-3-3 3" />
                                        <path d="M6 12h.01" />
                                        <circle cx="12" cy="12" r="2" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-sm text-white">Withdraw History</p>
                                </div>
                                <div class="flex-none text-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('settings.profile') }}">
                        <div class="bg-trade w-full rounded-sm flex flex-col space-y-2 p-3 mb-3 lg:mb-0">
                            <div class="flex items-center space-x-2">
                                <div class="flex-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                        viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-cog-icon lucide-cog">
                                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z" />
                                        <path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                        <path d="M12 2v2" />
                                        <path d="M12 22v-2" />
                                        <path d="m17 20.66-1-1.73" />
                                        <path d="M11 10.27 7 3.34" />
                                        <path d="m20.66 17-1.73-1" />
                                        <path d="m3.34 7 1.73 1" />
                                        <path d="M14 12h8" />
                                        <path d="M2 12h2" />
                                        <path d="m20.66 7-1.73 1" />
                                        <path d="m3.34 17 1.73-1" />
                                        <path d="m17 3.34-1 1.73" />
                                        <path d="m11 13.73-4 6.93" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-sm text-white">Settings</p>
                                </div>
                                <div class="flex-none text-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('dashboard.referrals') }}">
                        <div class="bg-trade w-full rounded-sm flex flex-col space-y-2 p-3 mb-3 lg:mb-0">
                            <div class="flex items-center space-x-2">
                                <div class="flex-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-sm text-white">Referrals</p>
                                </div>
                                <div class="flex-none text-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <a class="cursor-pointer" onclick="this.closest('form').submit()">
                            <div class="bg-trade w-full rounded-sm flex flex-col space-y-2 p-3 mb-3 lg:mb-0">
                                <div class="flex items-center space-x-2">
                                    <div class="flex-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                            viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-log-out-icon lucide-log-out">
                                            <path d="m16 17 5-5-5-5" />
                                            <path d="M21 12H9" />
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-sm text-white">Logout</p>
                                    </div>
                                    <div class="flex-none text-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-chevron-right-icon lucide-chevron-right">
                                            <path d="m9 18 6-6-6-6" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
