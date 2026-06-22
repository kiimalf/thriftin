<div class="bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Shopping Cart</h1>
            <p class="mt-2 text-sm text-gray-500">Review your selected items before checkout.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <form class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <section aria-labelledby="cart-heading" class="lg:col-span-7">
                <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                    @forelse($cartItems as $item)
                        <li class="flex py-6 sm:py-10">
                            <div class="flex-shrink-0">
                                @if($item->product->primaryImage)
                                    <img src="{{ $item->product->primaryImage->url }}" alt="{{ $item->product->title }}" class="w-24 h-24 rounded-md object-center object-cover sm:w-48 sm:h-48">
                                @else
                                    <div class="w-24 h-24 rounded-md bg-gray-200 sm:w-48 sm:h-48"></div>
                                @endif
                            </div>

                            <div class="ml-4 flex-1 flex flex-col justify-between sm:ml-6">
                                <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                    <div>
                                        <div class="flex justify-between">
                                            <h3 class="text-sm">
                                                <a href="{{ route('products.show', $item->product->slug) }}" class="font-medium text-gray-700 hover:text-gray-800">
                                                    {{ $item->product->title }}
                                                </a>
                                            </h3>
                                        </div>
                                        <div class="mt-1 flex text-sm">
                                            <p class="text-gray-500">Condition: {{ ucwords(str_replace('_', ' ', $item->product->condition)) }}</p>
                                            @if($item->product->size)
                                                <p class="ml-4 pl-4 border-l border-gray-200 text-gray-500">{{ $item->product->size }}</p>
                                            @endif
                                        </div>
                                        <p class="mt-1 text-sm font-medium text-gray-900">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    </div>

                                    <div class="mt-4 sm:mt-0 sm:pr-9">
                                        <label for="quantity-{{ $item->id }}" class="sr-only">Quantity</label>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>

                                        <div class="absolute top-0 right-0">
                                            <button type="button" wire:click="remove({{ $item->id }})" class="-m-2 p-2 inline-flex text-gray-400 hover:text-gray-500">
                                                <span class="sr-only">Remove</span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <p class="mt-4 flex text-sm text-gray-700 space-x-2">
                                    <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span>In stock</span>
                                </p>
                            </div>
                        </li>
                    @empty
                        <li class="py-12 text-center">
                            <p class="text-gray-500 mb-4">Your cart is empty.</p>
                            <a href="{{ route('products.index') }}" class="text-primary-600 hover:text-primary-500 font-medium">Continue Shopping &rarr;</a>
                        </li>
                    @endforelse
                </ul>
            </section>

            <!-- Order summary -->
            <section aria-labelledby="summary-heading" class="mt-16 bg-gray-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">
                <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

                <dl class="mt-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <dt class="text-sm text-gray-600">Subtotal</dt>
                        <dd class="text-sm font-medium text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</dd>
                    </div>
                    <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                        <dt class="flex text-sm text-gray-600">
                            <span>Shipping estimate</span>
                        </dt>
                        <dd class="text-sm font-medium text-gray-900">Calculated at checkout</dd>
                    </div>
                    <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                        <dt class="text-base font-medium text-gray-900">Order total</dt>
                        <dd class="text-base font-medium text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <a href="{{ route('checkout.index') }}" class="w-full flex justify-center items-center px-4 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-primary-500 {{ $cartItems->isEmpty() ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                        Proceed to Checkout
                    </a>
                </div>
            </section>
        </form>
    </div>
</div>
