<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <a href="{{ route('job-posts.index') }}"
               class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                View Job Posts
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
                    Create Job Post
                </h3>

                <form method="POST" action="{{ route('job-posts.store') }}">
                    @csrf

                    <!-- Title -->
                    <div class="mb-4">
                        <x-input-label for="title" value="Job Title" />
                        <x-text-input id="title" name="title" class="block mt-1 w-full"
                                      value="{{ old('title') }}" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <x-input-label for="description" value="Description" />
                        <textarea name="description" id="description"
                                  class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700
                                  dark:bg-gray-900 dark:text-gray-300">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Benefit -->
                    <div class="mb-4">
                        <x-input-label for="benifit" value="Benefit" />
                        <x-text-input id="benifit" name="benifit" class="block mt-1 w-full"
                                      value="{{ old('benifit') }}" />
                    </div>

                    <!-- Age -->
                    <div class="mb-4">
                        <x-input-label for="age" value="Age Requirement" />
                        <x-text-input id="age" name="age" class="block mt-1 w-full"
                                      value="{{ old('age') }}" />
                    </div>

                    <!-- Salary -->
                    <div class="mb-6">
                        <x-input-label for="salary" value="Salary" />
                        <x-text-input id="salary" name="salary" class="block mt-1 w-full"
                                      value="{{ old('salary') }}" />
                    </div>

                    <!-- Submit -->
                    <x-primary-button>
                        Create Job
                    </x-primary-button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
