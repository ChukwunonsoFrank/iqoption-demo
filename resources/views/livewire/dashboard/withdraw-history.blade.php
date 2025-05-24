<div class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:pl-6 lg:pr-4">
            <div class="mb-3 sticky top-0 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Withdrawals</h1>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll">

                <div class="bg-trade w-full rounded-sm flex flex-col space-y-2 p-3 mb-3">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-[10px] font-semibold border border-gray-500 text-white"><span class="size-1 inline-block rounded-full bg-red-600"></span> Pending</span>
                        </div>
                        <div class="flex-1 text-end">
                            <p class="text-white text-xs">9:38</p>
                            <p class="text-gray-400 text-[10px]">12 Apr</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex-none">
                            <img class="md:w-7" src="https://olympmatix.com/icons/assets/BITCOIN.svg" alt="">
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-xs text-white md:text-sm">Bitcoin</p>
                        </div>
                        <div class="flex-none text-end">
                            <p class="font-semibold text-sm md:text-base text-white">-$100.90</p>
                        </div>
                    </div>
                </div>

                <div class="bg-trade w-full rounded-sm flex flex-col space-y-2 p-3 mb-3">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-full text-[10px] font-semibold border border-gray-500 text-white"><span class="size-1 inline-block rounded-full bg-teal-600"></span> Confirmed</span>
                        </div>
                        <div class="flex-1 text-end">
                            <p class="text-white text-xs">12:13</p>
                            <p class="text-gray-400 text-[10px]">12 Apr</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex-none">
                            <img class="md:w-7" src="https://olympmatix.com/icons/assets/BITCOIN.svg" alt="">
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-xs text-white md:text-sm">Bitcoin</p>
                        </div>
                        <div class="flex-none text-end">
                            <p class="font-semibold text-sm md:text-base text-white">-$189.90</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-normal rounded-full border border-gray-400 text-white shadow-2xs disabled:opacity-50 disabled:pointer-events-none">
                        Load more <i class="fas fa-rotate"></i>
                      </button>
                </div>
            </div>
        </div>
    </div>
</div>



