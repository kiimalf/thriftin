<div>
    @section('title', 'User Management')

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="relative w-full sm:w-96">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 sm:text-sm" placeholder="Search by name or email...">
        </div>

        <div class="flex border border-gray-300 rounded-md overflow-hidden">
            <button wire:click="$set('status', 'all')" class="px-4 py-2 text-sm font-medium {{ $status === 'all' ? 'bg-slate-100 text-slate-800' : 'bg-white text-gray-600 hover:bg-gray-50' }} border-r border-gray-300">
                All
            </button>
            <button wire:click="$set('status', 'active')" class="px-4 py-2 text-sm font-medium {{ $status === 'active' ? 'bg-slate-100 text-slate-800' : 'bg-white text-gray-600 hover:bg-gray-50' }} border-r border-gray-300">
                Active
            </button>
            <button wire:click="$set('status', 'suspended')" class="px-4 py-2 text-sm font-medium {{ $status === 'suspended' ? 'bg-slate-100 text-slate-800' : 'bg-white text-gray-600 hover:bg-gray-50' }}">
                Suspended
            </button>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 bg-gray-50/50 uppercase">
                    <tr>
                        <th class="px-6 py-4 font-medium">User</th>
                        <th class="px-6 py-4 font-medium">Joined Date</th>
                        <th class="px-6 py-4 font-medium">Listings</th>
                        <th class="px-6 py-4 font-medium">Orders</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($user->avatar)
                                    <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ $user->avatar }}" alt="">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold mr-3 text-sm">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="font-medium text-gray-900 flex items-center">
                                        {{ $user->name }}
                                        @if($user->is_admin)
                                            <span class="ml-2 px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-800 text-white uppercase tracking-wider">Admin</span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->products_count }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->orders_count }}</td>
                        <td class="px-6 py-4">
                            @if($user->is_suspended)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Suspended
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($user->id !== auth()->id() && !$user->is_admin)
                                <button wire:click="toggleSuspend({{ $user->id }})" class="text-sm font-medium {{ $user->is_suspended ? 'text-green-600 hover:text-green-900' : 'text-red-600 hover:text-red-900' }}">
                                    {{ $user->is_suspended ? 'Unsuspend' : 'Suspend' }}
                                </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No users found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
