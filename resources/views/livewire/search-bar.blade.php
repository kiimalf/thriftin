<div class="relative w-full">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
    <form wire:submit="search" class="w-full">
        <input type="text" 
            wire:model="query"
            class="block w-full pl-10 pr-4 py-2.5 rounded-full leading-5 bg-gray-100 border-0 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary-200 focus:border-primary-300 sm:text-sm transition-all duration-200" 
            placeholder="Search for brands, categories, or items..." />
    </form>
</div>
