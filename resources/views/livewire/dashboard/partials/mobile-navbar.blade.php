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
        <a class="block" wire:click="robot()">
            <div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="#D4D4D4"
                        stroke-width="{{ request()->is('dashboard/robot') || request()->is('dashboard/robot/traderoom') ? 2 : 1 }}" stroke-linecap="round"
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