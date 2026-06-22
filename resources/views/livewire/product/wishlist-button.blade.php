<button type="button" wire:click="toggleWishlist" class="group p-2 rounded-full flex items-center justify-center focus:outline-none transition-all duration-200 bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md hover:bg-white {{ $isLoved ? 'text-red-500' : 'text-gray-400 hover:text-red-400' }}">
    <span class="sr-only">Add to favorites</span>
    <svg class="h-5 w-5 transition-transform duration-200 {{ $isLoved ? 'scale-110' : 'group-hover:scale-110' }}" fill="{{ $isLoved ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
    </svg>
</button>
