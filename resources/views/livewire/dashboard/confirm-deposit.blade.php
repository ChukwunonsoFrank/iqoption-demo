<div x-data="confirmDepositPageComponent" x-init="generateQRCode()" class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-80 lg:pt-6">
            <div class="mb-3 sticky top-0 bg-dashboard pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Make a deposit</h1>
            </div>
            <div class="text-sm text-white bg-navbar rounded-lg p-4 border-[0.1px] border-gray-700 mb-5"
                    role="alert" tabindex="-1" aria-labelledby="hs-with-description-label">
                    <div class="flex">
                        <div class="shrink-0 text-yellow-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                        </div>
                        <div class="ms-2">
                            <h3 id="hs-with-description-label" class="text-xs font-semibold">
                                Send only BTC to this address
                            </h3>
                            <div class="mt-1 text-[11px] text-zinc-300">
                                Sending coins or tokens other than BTC to this address may result in the loss of your deposit
                            </div>
                        </div>
                    </div>
                </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll">
                <div class="mb-8 text-center">
                    <p class="block text-sm font-medium mb-2 text-white">Pay the exact amount of $100 in BTC to the address below</p>
                </div>

                <div class="mb-4 text-center">
                    <p class="block text-xs font-medium mb-2 text-zinc-300">Scan QR code to make payment</p>
                </div>

                <div class="flex items-center justify-center mb-4">
                    <div class="w-24 h-24 bg-[#FFFFFF] p-2 flex rounded-md">
                        <div class="w-36 h-36" id="qrcode"></div>
                    </div>
                </div>

                <div class="flex items-center justify-center mb-10">
                    <input type="hidden" id="hs-clipboard-tooltip" value="test-wallet-address">

                    <button type="button"
                        class="js-clipboard-example [--trigger:focus] hs-tooltip relative py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-mono font-bold rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                        data-clipboard-target="#hs-clipboard-tooltip" data-clipboard-action="copy"
                        data-clipboard-success-text="Copied">
                        test-wallet-address
                        <span class="border-s border-gray-200 ps-3.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy-icon lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                        </span>
                        
                        <span
                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity hidden invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-lg shadow-2xs"
                            role="tooltip">
                            Copied
                        </span>
                    </button>
                </div>

                <div class="md:px-52">
                    <a href="{{ route('dashboard.deposit.confirm') }}" wire:navigate>
                        <button type="button"
                            class="py-3 cursor-pointer px-4 w-full md:px-6 md:py-3 text-center gap-x-2 text-sm md:text-base font-semibold rounded-lg bg-accent text-white focus:outline-hidden">
                            Confirm payment
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('confirmDepositPageComponent', () => ({
            generateQRCode() {
                var qrcode = new QRCode("qrcode");
                qrcode.makeCode('test-wallet-address');
            }
        }))
    })
</script>
