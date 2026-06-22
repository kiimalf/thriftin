<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-6">
                        @if($notifications->count() > 0)
                            <form action="{{ route('notifications.readAll') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm text-primary-600 hover:text-primary-800 font-medium">Mark all as read</button>
                            </form>
                        @endif
                    </div>

                    @if(session('message'))
                        <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4">
                            <p class="text-sm text-green-700">{{ session('message') }}</p>
                        </div>
                    @endif

                    <div class="space-y-4">
                        @forelse($notifications as $notification)
                            <a href="{{ route('notifications.read', $notification->id) }}" class="block p-4 border rounded-lg transition {{ is_null($notification->read_at) ? 'bg-primary-50 border-primary-200' : 'bg-white border-gray-200 hover:bg-gray-50' }}">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 {{ is_null($notification->read_at) ? 'text-primary-800' : '' }}">{{ $notification->title }}</h4>
                                        <p class="text-sm text-gray-600 mt-1">{{ $notification->body }}</p>
                                    </div>
                                    <span class="text-xs text-gray-500 whitespace-nowrap ml-4">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No notifications yet</h3>
                                <p class="mt-1 text-sm text-gray-500">When you get updates, they'll show up here.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
