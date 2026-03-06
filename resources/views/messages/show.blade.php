<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('messages.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="w-9 h-9 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $user->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 flex flex-col" style="height: calc(100vh - 160px);">

            <!-- Messages Area -->
            <div id="messages-container"
                 class="flex-1 overflow-y-auto bg-white dark:bg-gray-800 rounded-t-lg shadow px-6 py-4 space-y-3">

                @forelse ($messages as $msg)
                    @if ($msg->sender_id === Auth::id())
                        {{-- Sent message (right) --}}
                        <div class="flex justify-end">
                            <div class="max-w-xs lg:max-w-md">
                                <div class="bg-indigo-500 text-white rounded-2xl rounded-br-sm px-4 py-2 text-sm shadow">
                                    {{ $msg->message }}
                                </div>
                                <p class="text-xs text-gray-400 mt-1 text-right">{{ $msg->created_at->format('g:i A') }}</p>
                            </div>
                        </div>
                    @else
                        {{-- Received message (left) --}}
                        <div class="flex justify-start gap-2">
                            <div class="w-8 h-8 rounded-full bg-gray-400 flex items-center justify-center text-white font-bold text-xs flex-shrink-0 mt-1">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="max-w-xs lg:max-w-md">
                                <div class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-2xl rounded-bl-sm px-4 py-2 text-sm shadow">
                                    {{ $msg->message }}
                                </div>
                                <p class="text-xs text-gray-400 mt-1">{{ $msg->created_at->format('g:i A') }}</p>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="flex flex-col items-center justify-center h-full text-gray-400 dark:text-gray-500 py-16">
                        <svg class="h-12 w-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M8 10h.01M12 10h.01M16 10h.01M21 16c0 1.1-.9 2-2 2H7l-4 4V6a2 2 0 012-2h14a2 2 0 012 2v10z"/>
                        </svg>
                        <p class="text-sm">No messages yet. Say hello!</p>
                    </div>
                @endforelse
            </div>

            <!-- Send Message Form -->
            <div class="bg-white dark:bg-gray-800 rounded-b-lg shadow border-t border-gray-200 dark:border-gray-700 px-4 py-3">
                @if (session('success'))
                    <p class="text-green-500 text-xs mb-2">{{ session('success') }}</p>
                @endif
                <form action="{{ route('messages.store', $user) }}" method="POST" class="flex items-center gap-3">
                    @csrf
                    <input
                        type="text"
                        name="message"
                        placeholder="Type a message..."
                        autocomplete="off"
                        required
                        class="flex-1 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    />
                    <button type="submit"
                            class="bg-indigo-500 hover:bg-indigo-600 text-white rounded-full p-2 transition">
                        <svg class="w-5 h-5 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </form>
                @error('message')
                    <p class="text-red-500 text-xs mt-1 pl-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <script>
        // Auto-scroll to bottom of messages
        const container = document.getElementById('messages-container');
        if (container) container.scrollTop = container.scrollHeight;
    </script>
</x-app-layout>
