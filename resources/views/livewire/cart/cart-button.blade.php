<a href="{{ route('cart.index') }}" class="relative inline-flex items-center text-gray-500 hover:text-primary-600 transition-colors duration-200">
    <svg class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
    </svg>
    @if($count > 0)
        <span class="absolute -top-1.5 -right-1.5 inline-flex items-center justify-center h-4 w-4 rounded-full bg-primary-500 text-white text-[10px] font-medium ring-2 ring-white">{{ $count }}</span>
    @endif
    <span class="sr-only">items in cart, view bag</span>
</a>
