<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Images') }} — {{ $vehicle->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Upload Form --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Upload Images</h3>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                @endif

                <form action="{{ route('vehicles.images.store', $vehicle) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Images</label>
                        <input type="file" name="images[]" multiple accept="image/*"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('images')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        @error('images.*')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Upload</button>
                        <a href="{{ route('vehicles.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Back to Vehicles</a>
                    </div>
                </form>
            </div>

            {{-- Image Gallery --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Uploaded Images ({{ $images->count() }})</h3>

                @if($images->isEmpty())
                    <p class="text-gray-500">No images uploaded yet.</p>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($images as $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                alt="Vehicle Image"
                                class="w-full h-40 object-cover rounded border border-gray-200">
                            <form action="{{ route('vehicles.images.destroy', [$vehicle, $image]) }}" method="POST"
                                class="absolute top-1 right-1"
                                onsubmit="return confirm('Delete this image?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white text-xs px-2 py-1 rounded hover:bg-red-700 opacity-0 group-hover:opacity-100 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
