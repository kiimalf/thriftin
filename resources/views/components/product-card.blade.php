@props(['product'])

<div class="group relative bg-white border border-gray-100 rounded-2xl flex flex-col overflow-hidden card-hover">
    <div class="aspect-[3/4] w-full bg-gray-50 relative overflow-hidden">
        @if($product->primaryImage)
            <img src="{{ $product->primaryImage->url }}" alt="{{ $product->title }}" class="w-full h-full object-center object-cover img-zoom">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-300">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            </div>
        @endif
        
        <!-- Wishlist Button -->
        <div class="absolute top-2.5 right-2.5">
            @livewire('product.wishlist-button', ['product' => $product], key('wishlist-'.$product->id))
        </div>

        <!-- Condition Badge -->
        <div class="absolute bottom-2.5 left-2.5">
            <span class="badge glass text-gray-700 text-[11px] shadow-sm">
                {{ ucwords(str_replace('_', ' ', $product->condition)) }}
            </span>
        </div>
    </div>
    
    <div class="flex-1 p-4 space-y-1.5 flex flex-col">
        <h3 class="text-sm font-medium text-gray-900 line-clamp-1">
            <a href="{{ route('products.show', $product) }}">
                <span aria-hidden="true" class="absolute inset-0 z-0"></span>
                {{ $product->title }}
            </a>
        </h3>
        <p class="text-xs text-gray-400 line-clamp-1">{{ $product->brand ?? 'No Brand' }} · Size: {{ $product->size ?? 'N/A' }}</p>
        <div class="flex-1 flex items-end justify-between">
            <p class="text-base font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>
        <div class="pt-2.5 mt-1.5 border-t border-gray-50 flex items-center">
            @if($product->seller->avatar)
                <img src="{{ $product->seller->avatar }}" alt="" class="w-5 h-5 rounded-full mr-2 ring-1 ring-gray-100">
            @else
                <div class="w-5 h-5 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center text-[10px] font-semibold mr-2">
                    {{ substr($product->seller->name, 0, 1) }}
                </div>
            @endif
            <p class="text-xs text-gray-400">{{ $product->seller->name }}</p>
        </div>
    </div>
</div>
