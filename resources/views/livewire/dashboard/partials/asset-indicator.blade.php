<div class="bg-asset-indicator rounded-sm flex space-x-2 p-2 items-center md:order-1 md:flex-none md:w-1/3 lg:w-1/6">
    <div class="flex-none">
        @if ($this->activeBot)
            <img src="{{ asset($this->activeBot['asset_image_url']) }}" alt="">
        @else
            <img src="{{ asset('assets/icons/dashboard/btc.svg') }}" alt="">
        @endif
    </div>
    <div class="flex-1">
        @if ($this->activeBot)
            <p class="text-white text-[12px] font-semibold">
                {{ $this->activeBot['asset'] }}
            </p>
            <p class="text-zinc-300 text-[9px] md:text-[10px]">{{ ucfirst($this->activeBot['asset_class']) }}</p>
        @else
            <p class="text-white text-[12px] font-semibold">
                Bitcoin
            </p>
            <p class="text-zinc-300 text-[9px] md:text-[10px]">Crypto</p>
        @endif
    </div>
    <div class="flex-none pr-4">
        @if ($this->activeBot)
            <span class="flex absolute size-3 -mt-1.5 -me-1.5">
                <span class="animate-ping absolute inline-flex size-full rounded-full bg-green-600 opacity-75"></span>
                <span class="relative inline-flex rounded-full size-3 bg-green-500"></span>
            </span>
        @endif
    </div>
</div>
