@props(['product'])

<div class="group relative bg-white border border-gray-200 rounded-xl flex flex-col overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <div class="aspect-w-3 aspect-h-4 bg-gray-200 sm:aspect-none h-48 relative">
        @if($product->primaryImage)
            <img src="{{ $product->primaryImage->url }}" alt="{{ $product->title }}" class="w-full h-full object-center object-cover sm:w-full sm:h-full">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                No Image
            </div>
        @endif
        
        <!-- Wishlist Button -->
        <div class="absolute top-2 right-2">
            @livewire('product.wishlist-button', ['product' => $product], key('wishlist-'.$product->id))
        </div>

        <!-- Condition Badge -->
        <div class="absolute bottom-2 left-2">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/90 text-gray-800 shadow-sm backdrop-blur-sm">
                {{ ucwords(str_replace('_', ' ', $product->condition)) }}
            </span>
        </div>
    </div>
    
    <div class="flex-1 p-4 space-y-2 flex flex-col">
        <h3 class="text-sm font-medium text-gray-900 line-clamp-1">
            <a href="{{ route('products.show', $product) }}">
                <span aria-hidden="true" class="absolute inset-0 z-0"></span>
                {{ $product->title }}
            </a>
        </h3>
        <p class="text-sm text-gray-500 line-clamp-1">{{ $product->brand ?? 'No Brand' }} &middot; Size: {{ $product->size ?? 'N/A' }}</p>
        <div class="flex-1 flex items-end justify-between">
            <p class="text-base font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>
        <div class="pt-2 mt-2 border-t border-gray-100 flex items-center">
            @if($product->seller->avatar)
                <img src="{{ $product->seller->avatar }}" alt="" class="w-5 h-5 rounded-full mr-2">
            @else
                <div class="w-5 h-5 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-[10px] font-bold mr-2">
                    {{ substr($product->seller->name, 0, 1) }}
                </div>
            @endif
            <p class="text-xs text-gray-500">{{ $product->seller->name }}</p>
        </div>
    </div>
</div>
