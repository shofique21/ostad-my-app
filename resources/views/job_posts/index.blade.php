<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Job Posts') }}
            </h2>

            <a href="{{ route('dashboard') }}"
               class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                Back to Dashboard
            </a>
            <a href="{{route('job-post')}}">Job Post</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Title</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Salary</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Age</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($jobs as $job)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-medium">{{ $job->title }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ Str::limit($job->description, 60) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $job->salary ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $job->age ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4 flex gap-3">
                                    <a href="{{ route('job-posts.edit', $job->id) }}"
                                       class="text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('job-posts.destroy', $job->id) }}"
                                          onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                    No job posts found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
