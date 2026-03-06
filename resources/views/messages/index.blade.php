<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Conversations</h3>
                </div>

                @forelse ($conversations as $msg)
                    @php
                        $partner = $msg->sender_id === Auth::id() ? $msg->receiver : $msg->sender;
                    @endphp
                    <a href="{{ route('messages.show', $partner) }}"
                       class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700 transition">
                        <!-- Avatar -->
                        <div class="w-11 h-11 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                            {{ strtoupper(substr($partner->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-800 dark:text-gray-100 truncate">{{ $partner->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $msg->message }}</p>
                        </div>
                        <span class="text-xs text-gray-400 whitespace-nowrap">{{ $msg->created_at->diffForHumans() }}</span>
                    </a>
                @empty
                    <div class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                        <svg class="mx-auto mb-3 h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M8 10h.01M12 10h.01M16 10h.01M21 16c0 1.1-.9 2-2 2H7l-4 4V6a2 2 0 012-2h14a2 2 0 012 2v10z"/>
                        </svg>
                        <p>No conversations yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
