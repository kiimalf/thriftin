<x-app-layout>
    <div class="bg-gray-50 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="px-6 py-8 border-b border-gray-200 text-center">
                    <h2 class="text-2xl font-extrabold text-gray-900">Complete Your Payment</h2>
                    <p class="mt-2 text-sm text-gray-500">Please review your order details before proceeding to payment.</p>
                </div>
                
                <div class="px-6 py-6 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h3>
                    
                    <ul class="divide-y divide-gray-200">
                        @foreach($orders as $order)
                        <li class="py-4 flex justify-between">
                            <div class="flex">
                                <img src="{{ $order->product->primaryImage ? $order->product->primaryImage->url : '' }}" alt="" class="h-16 w-16 rounded-md object-cover">
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $order->product->title }}</h4>
                                    <p class="mt-1 text-sm text-gray-500">Shipping: {{ $order->shipping_provider }} (Rp {{ number_format($order->shipping_cost, 0, ',', '.') }})</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <div class="flex justify-between text-base font-bold text-gray-900">
                            <p>Total Payment</p>
                            <p>Rp {{ number_format($grossAmount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-8 text-center">
                    <button id="pay-button" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Proceed to Payment
                    </button>
                    <p class="mt-4 text-xs text-gray-500">Secured by Midtrans Payment Gateway</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    window.location.href = "{{ route('payment.success', ['order_id' => $orders->first()->midtrans_order_id]) }}";
                },
                onPending: function(result){
                    alert("Waiting your payment!");
                    window.location.href = "{{ route('orders.index') }}"; // Buyer order history
                },
                onError: function(result){
                    alert("Payment failed!");
                },
                onClose: function(){
                    alert('You closed the popup without finishing the payment');
                }
            });
        };
    </script>
    @endpush
</x-app-layout>
