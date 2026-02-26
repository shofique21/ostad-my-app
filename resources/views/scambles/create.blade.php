<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Create Scamble Data
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 text-red-500">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('scambles.store') }}">
                    @csrf

                    <!-- Text -->
                    <div class="mb-4">
                        <label class="block mb-2">Original Text</label>
                        <input type="text"
                               name="original_text"
                               class="w-full border rounded p-2"
                               required>
                    </div>

                    <!-- Type -->
                    <div class="mb-4">
                        <label class="block mb-2">Scramble Type</label>
                        <select name="type" class="w-full border rounded p-2">
                            <option value="reverse">Reverse</option>
                            <option value="shuffle">Shuffle</option>
                            <option value="alternate">Alternate Case</option>
                            <option value="hash">Hash Case</option>
                            <option value="base64">Base64 Case</option>
                        </select>
                    </div>

                    <!-- Button -->
                    <button class="bg-blue-500 text-white px-4 py-2 rounded">
                        Save & Scramble
                    </button>

                    <a href="{{ route('scambles.index') }}"
                       class="ml-3 text-gray-600">
                        Back
                    </a>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>