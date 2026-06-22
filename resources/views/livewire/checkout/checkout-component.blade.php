<div class="bg-white min-h-screen">
    <!-- Header -->
    <div class="max-w-7xl mx-auto pt-10 pb-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900">Checkout</h1>
        <p class="mt-1 text-sm text-gray-500">Complete your order securely.</p>
    </div>

    <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        <h2 class="sr-only">Checkout</h2>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            <!-- Left side: Shipping details -->
            <div>
                @if (session()->has('error'))
                    <div class="rounded-xl bg-red-50 border border-red-100 p-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <div class="mb-10">
                    <h2 class="text-base font-semibold text-gray-900">Shipping Information</h2>

                    @if($addresses->count() > 0)
                        <div class="mt-4 space-y-3">
                            @foreach($addresses as $address)
                                <div class="border {{ $selectedAddressId == $address->id ? 'border-primary-500 bg-primary-50/50 ring-1 ring-primary-500' : 'border-gray-100 bg-white' }} rounded-2xl p-4 cursor-pointer relative transition-all duration-200 hover:shadow-sm" wire:click="$set('selectedAddressId', {{ $address->id }})">
                                    <div class="flex items-start gap-3">
                                        <input type="radio" name="address" wire:model="selectedAddressId" value="{{ $address->id }}" class="mt-0.5 focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300">
                                        <div class="flex-1 min-w-0">
                                            <span class="block text-sm font-semibold text-gray-900">{{ $address->label }} — {{ $address->recipient_name }}</span>
                                            <span class="block mt-0.5 text-sm text-gray-500">{{ $address->phone }}</span>
                                            <span class="block mt-0.5 text-sm text-gray-500 leading-relaxed">{{ $address->detail }}, {{ $address->district ? $address->district . ', ' : '' }}{{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}</span>
                                        </div>
                                        @if($address->is_default)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                                Default
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-5">
                            <button type="button" wire:click="toggleNewAddressForm" class="inline-flex items-center gap-1 text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    @if($showNewAddressForm)
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    @endif
                                </svg>
                                {{ $showNewAddressForm ? 'Cancel new address' : 'Add new address' }}
                            </button>
                        </div>
                    @else
                        <p class="mt-4 text-sm text-gray-500">You don't have any shipping addresses saved. Please add one below.</p>
                        @php $showNewAddressForm = true; @endphp
                    @endif

                    @if($showNewAddressForm)
                        <div class="mt-6 bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                            <h3 class="text-sm font-semibold text-gray-900 mb-5">Add New Address</h3>
                            <div class="grid grid-cols-1 gap-y-5 sm:grid-cols-2 sm:gap-x-4">
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Address Label (e.g., Home, Office)</label>
                                    <input type="text" wire:model="label" class="block w-full border border-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3.5 py-2.5 transition-colors duration-200 placeholder:text-gray-400">
                                    @error('label') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Recipient Name</label>
                                    <input type="text" wire:model="recipient_name" class="block w-full border border-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3.5 py-2.5 transition-colors duration-200 placeholder:text-gray-400">
                                    @error('recipient_name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Phone Number</label>
                                    <input type="text" wire:model="phone" class="block w-full border border-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3.5 py-2.5 transition-colors duration-200 placeholder:text-gray-400">
                                    @error('phone') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Province</label>
                                    <input type="text" wire:model="province" class="block w-full border border-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3.5 py-2.5 transition-colors duration-200 placeholder:text-gray-400" placeholder="e.g. Jawa Barat">
                                    @error('province') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1.5">City / Kabupaten</label>
                                    <input type="text" wire:model="city" class="block w-full border border-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3.5 py-2.5 transition-colors duration-200 placeholder:text-gray-400" placeholder="e.g. Bandung">
                                    @error('city') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Full Address Details</label>
                                    <textarea wire:model="detail" rows="3" class="block w-full border border-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3.5 py-2.5 transition-colors duration-200 placeholder:text-gray-400" placeholder="Street name, building, house number..."></textarea>
                                    @error('detail') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Postal Code</label>
                                    <input type="text" wire:model="postal_code" class="block w-full border border-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm px-3.5 py-2.5 transition-colors duration-200 placeholder:text-gray-400">
                                    @error('postal_code') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="button" wire:click="saveAddress" class="inline-flex items-center gap-2 bg-primary-600 border border-transparent rounded-xl shadow-sm py-2.5 px-5 text-sm font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    Save Address
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Delivery Method -->
                <div class="mt-10 border-t border-gray-100 pt-10">
                    <h2 class="text-base font-semibold text-gray-900">Delivery Method</h2>

                    <div class="mt-4 grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-4">
                        <label class="relative bg-white border-2 border-primary-500 rounded-2xl shadow-sm p-5 flex cursor-pointer focus:outline-none ring-1 ring-primary-200 transition-all duration-200">
                            <input type="radio" name="delivery_method" value="JNE Reguler" class="sr-only" checked>
                            <span class="flex-1 flex">
                                <span class="flex flex-col">
                                    <span class="block text-sm font-semibold text-gray-900">JNE Reguler</span>
                                    <span class="mt-1 flex items-center text-sm text-gray-500">2–4 business days</span>
                                    <span class="mt-4 text-sm font-bold text-gray-900">Rp 15.000 / item</span>
                                </span>
                            </span>
                            <svg class="h-5 w-5 text-primary-600 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right side: Order summary -->
            <div class="mt-10 lg:mt-0">
                <h2 class="text-base font-semibold text-gray-900">Order Summary</h2>

                <div class="mt-4 bg-gray-50/50 border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                    <h3 class="sr-only">Items in your cart</h3>
                    <ul role="list" class="divide-y divide-gray-100">
                        @foreach($cartItems as $item)
                        <li class="flex gap-4 py-5 px-5 sm:px-6">
                            <div class="flex-shrink-0">
                                @if($item->product->primaryImage)
                                    <img src="{{ $item->product->primaryImage->url }}" alt="" class="w-16 h-16 rounded-lg object-center object-cover">
                                @else
                                    <div class="w-16 h-16 rounded-lg bg-gray-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-semibold text-gray-900 truncate">
                                    <a href="#" class="hover:text-primary-600 transition-colors duration-200">
                                        {{ $item->product->title }}
                                    </a>
                                </h4>
                                <p class="mt-0.5 text-xs text-gray-500">{{ $item->product->condition }}</p>
                                <div class="mt-1.5 flex items-center justify-between">
                                    <p class="text-sm font-bold text-gray-900">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    <span class="text-xs text-gray-500">Qty {{ $item->quantity }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <dl class="border-t border-gray-100 py-5 px-5 space-y-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-500">Subtotal</dt>
                            <dd class="text-sm font-semibold text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-500">Shipping ({{ $cartItems->count() }} items)</dt>
                            <dd class="text-sm font-semibold text-gray-900">Rp {{ number_format($totalShipping, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <dt class="text-base font-bold text-gray-900">Total</dt>
                            <dd class="text-base font-bold text-primary-600">Rp {{ number_format($total, 0, ',', '.') }}</dd>
                        </div>
                    </dl>

                    <div class="border-t border-gray-100 py-5 px-5 sm:px-6">
                        <button type="button" wire:click="processCheckout" class="w-full bg-primary-600 border border-transparent rounded-xl shadow-sm py-3.5 px-4 text-sm font-semibold text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 flex items-center justify-center gap-2" {{ !$selectedAddressId || $cartItems->isEmpty() ? 'disabled' : '' }}>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            Pay Now
                        </button>
                        @if(!$selectedAddressId)
                            <p class="text-xs text-red-500 text-center mt-2.5">Please select or add a shipping address before paying.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
