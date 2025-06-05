<div x-data class="px-4 lg:px-0 h-full">
    <div class="lg:flex lg:h-full">
        <livewire:dashboard.partials.desktop-navbar />
        <div class="lg:h-full lg:flex-1 lg:px-80 lg:pt-6">
            <div class="mb-3 sticky top-0 bg-dashboard z-10 pb-2 lg:pt-4">
                <h1 class="text-white text-lg md:text-xl lg:text-2xl font-semibold">Make a deposit</h1>
            </div>
            <div class="text-sm text-white bg-navbar rounded-lg p-4 border-[0.1px] border-gray-700 mb-5" role="alert"
                tabindex="-1" aria-labelledby="hs-with-description-label">
                <div class="flex">
                    <div class="shrink-0 text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert">
                            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3" />
                            <path d="M12 9v4" />
                            <path d="M12 17h.01" />
                        </svg>
                    </div>
                    <div class="ms-2">
                        <h3 id="hs-with-description-label" class="text-xs font-semibold">
                            Send only {{ $this->method }} to this address
                        </h3>
                        <div class="mt-1 text-[11px] text-zinc-300">
                            Sending coins or tokens other than {{ $this->method }} to this address may result in the
                            loss of your deposit
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:h-full lg:pb-24 lg:overflow-scroll">
                <div class="mb-8 text-center">
                    <p class="block text-sm font-medium mb-2 text-white">Pay the exact amount of @money($this->amount / 100) in
                        {{ $this->method }} to the address below</p>
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
                    <div class="w-full md:w-1/2 space-y-3">
                        <div>
                            <div class="relative">
                                <input id="address" type="text" id="hs-trailing-icon" name="hs-trailing-icon"
                                    class="py-2.5 sm:py-3 px-4 pe-11 block w-full bg-white border-gray-200 rounded-lg font-mono font-semibold text-sm focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
                                    value="{{ $this->address }}" readonly>
                                <div x-on:click="$store.confirmDepositPage.copyWalletAddress()"
                                    class="absolute inset-y-0 end-0 flex items-center cursor-pointer z-20 pe-4">
                                    <svg class="js-clipboard-default size-4 group-hover:rotate-6 transition"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="8" height="4" x="8" y="2" rx="1" ry="1">
                                        </rect>
                                        <path
                                            d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:px-52">
                    <a wire:click="createDeposit()">
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
        Alpine.store('confirmDepositPage', {
            init() {
                this.generateQRCode()
            },
            generateQRCode() {
                var qrcode = new QRCode("qrcode");
                var address = new URLSearchParams(window.location.search).get('address');
                qrcode.makeCode(address);
            },
            toast() {
                const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">Copied</p>
                    </div>
                </div>
            `;

                Toastify({
                    text: toastMarkup,
                    className: "hs-toastify-on:opacity-100 opacity-0 border border-gray-700 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-navbar text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                    duration: 4000,
                    close: true,
                    escapeMarkup: false
                }).showToast();
            },
            copyWalletAddress() {
                var copyText = document.getElementById("address");
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices
                navigator.clipboard.writeText(copyText.value);
                this.toast();
            }
        })
    })
</script>

@script
    <script>
        $wire.on('deposit-error', (event) => {
            const toastMarkup = `
                <div class="flex items-center p-4">
                    <div class="shrink-0">
                        <svg class="shrink-0 size-4 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
                        </svg>
                    </div>
                    <div class="ms-3 flex-1">
                        <p class="text-xs font-semibold text-white">${event.message}</p>
                    </div>
                </div>
            `;

            Toastify({
                text: toastMarkup,
                className: "hs-toastify-on:opacity-100 opacity-0 border border-gray-700 absolute top-0 start-1/2 -translate-x-1/2 z-90 w-4/5 md:w-1/2 lg:w-1/4 transition-all duration-300 bg-navbar text-sm text-white rounded-xl shadow-lg [&>.toast-close]:hidden",
                duration: 4000,
                close: true,
                escapeMarkup: false
            }).showToast();
        });
    </script>
@endscript