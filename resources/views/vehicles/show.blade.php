<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicle Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                @endif

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">{{ $vehicle->title }}</h3>
                    <div class="space-x-2 flex items-center">
                        <!-- Favourite Toggle -->
                        @auth
                            @php $isFav = \App\Models\Favorite::where('user_id', auth()->id())->where('vehicle_id', $vehicle->id)->exists(); @endphp
                            @if($isFav)
                                <form action="{{ route('favourites.destroy', $vehicle) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">&#9829; Unfavourite</button>
                                </form>
                            @else
                                <form action="{{ route('favourites.store', $vehicle) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded">&#9825; Favourite</button>
                                </form>
                            @endif
                        @endauth
                        <!-- Toggle Active -->
                        <form action="{{ route('vehicles.toggle-active', $vehicle) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            @if($vehicle->is_active)
                                <button type="submit" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded">Deactivate</button>
                            @else
                                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Activate</button>
                            @endif
                        </form>
                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="inline" onsubmit="return confirm('Delete this vehicle?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                        </form>
                        <a href="{{ route('vehicles.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Back</a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-4">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Status</span>
                            <p class="mt-1">
                                @if($vehicle->is_active)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm">Inactive</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Category</span>
                            <p class="mt-1 text-gray-800">{{ $vehicle->category->name ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Brand</span>
                            <p class="mt-1 text-gray-800">{{ $vehicle->brand ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Model</span>
                            <p class="mt-1 text-gray-800">{{ $vehicle->model ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Year</span>
                            <p class="mt-1 text-gray-800">{{ $vehicle->year ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Condition</span>
                            <p class="mt-1 text-gray-800">{{ $vehicle->condition ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Mileage</span>
                            <p class="mt-1 text-gray-800">{{ $vehicle->milage ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Fuel Type</span>
                            <p class="mt-1 text-gray-800">{{ $vehicle->fuel_type ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Transmission</span>
                            <p class="mt-1 text-gray-800">{{ $vehicle->transmission ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Location</span>
                            <p class="mt-1 text-gray-800">{{ $vehicle->location ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Contact Number</span>
                            <p class="mt-1 text-gray-800">{{ $vehicle->contact_number ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                @if($vehicle->description)
                <div class="mb-6">
                    <span class="text-sm font-medium text-gray-500">Description</span>
                    <p class="mt-1 text-gray-800 whitespace-pre-line">{{ $vehicle->description }}</p>
                </div>
                @endif

                <!-- Images -->
                <div>
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="text-lg font-semibold text-gray-700">Images</h4>
                        <a href="{{ route('vehicles.images.index', $vehicle) }}" class="px-3 py-1 bg-purple-600 text-white rounded hover:bg-purple-700 text-sm">Manage Images</a>
                    </div>
                    @if($vehicle->images->count())
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($vehicle->images as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Vehicle Image" class="w-full h-32 object-cover rounded shadow">
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">No images uploaded yet.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
