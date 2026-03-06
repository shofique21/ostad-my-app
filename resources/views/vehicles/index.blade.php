<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Vehicles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">All My Vehicles</h3>
                    <a href="{{ route('vehicles.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add Vehicle</a>
                </div>

                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Brand</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Year</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vehicles as $vehicle)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $vehicle->title }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $vehicle->category->name ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $vehicle->brand ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $vehicle->year ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if($vehicle->is_active)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">Inactive</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2 space-x-2">
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600" style="background-color:black;">Show</a>
                                <a href="{{ route('vehicles.images.index', $vehicle) }}" class="px-3 py-1 bg-purple-600 text-white rounded hover:bg-purple-700" style="background-color:purple;">Images</a>
                                <a href="{{ route('vehicles.edit', $vehicle) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600" style="background-color:yellow; color:black">Edit</a>
                                <form action="{{ route('vehicles.toggle-active', $vehicle) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    @if($vehicle->is_active)
                                        <button type="submit" class="px-3 py-1 bg-orange-500 hover:bg-orange-600 text-white rounded" style="background-color:orange;">Deactivate</button>
                                    @else
                                        <button type="submit" class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded" style="background-color:green;">Activate</button>
                                    @endif
                                </form>
                                <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="inline" onsubmit="return confirm('Delete this vehicle?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="border border-gray-300 px-4 py-4 text-center text-gray-500">No vehicles found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $vehicles->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
