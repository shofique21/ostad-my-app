<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Scambled Data List
        </h2>
        <a href="{{ route('scambles.create') }}" class="bg-green-500 text-white px-3 py-2 rounded">
            + Create New
        </a>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                    class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Original Text</th>
                            <th class="border p-2">Scrambled Text</th>
                            <th class="border p-2">Type</th>
                            <th class="border p-2">Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($scambles as $item)
                            <tr>
                                <td class="border p-2">{{ $item->id }}</td>
                                <td class="border p-2">{{ $item->original_text }}</td>
                                <td class="border p-2 text-blue-600 font-semibold">
                                    {{ $item->scamble_text }}
                                </td>
                                <td class="border p-2">{{ ucfirst($item->type) }}</td>
                                <td class="border p-2">
                                    {{ $item->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">
                                    No data found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>