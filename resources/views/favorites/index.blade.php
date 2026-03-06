<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Favourites') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                @endif

                @if($favorites->isEmpty())
                    <p class="text-gray-500">You have no favourite vehicles yet.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($favorites as $favorite)
                            @php $vehicle = $favorite->vehicle; @endphp
                            <div class="border rounded-lg overflow-hidden shadow-sm">
                                @if($vehicle->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $vehicle->images->first()->image_path) }}"
                                         alt="{{ $vehicle->title }}"
                                         class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                                @endif
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg text-gray-800">{{ $vehicle->title }}</h3>
                                    <p class="text-gray-500 text-sm mt-1">{{ $vehicle->brand }} &bull; {{ $vehicle->model }}</p>
                                    <p class="text-indigo-600 font-bold mt-2">${{ number_format($vehicle->price, 2) }}</p>
                                    <div class="mt-4 flex justify-between items-center">
                                        <a href="{{ route('vehicles.show', $vehicle) }}"
                                           class="px-3 py-1 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">View</a>
                                        <form action="{{ route('favourites.destroy', $vehicle) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
