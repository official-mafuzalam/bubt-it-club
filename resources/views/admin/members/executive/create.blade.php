<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Create Executive Committee | BUBT IT Club</title>
        @endsection

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Create Executive Committee
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Add a new executive committee term for BUBT IT Club
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.executive-committees.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    Back to Committees
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <form action="{{ route('admin.executive-committees.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Committee Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Committee Information</h3>

                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Committee Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('name') }}" placeholder="e.g., 2023-2024 Executive Committee">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Description
                                </label>
                                <textarea name="description" id="description" rows="3"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Brief description of this committee">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Term Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Term Information</h3>

                            <div>
                                <label for="term_start"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Term Start <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="term_start" id="term_start" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('term_start') }}">
                                @error('term_start')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="term_end"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Term End <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="term_end" id="term_end" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('term_end') }}">
                                @error('term_end')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="flex items-center justify-end p-6 bg-gray-50 dark:bg-gray-700 space-x-3">
                    <a href="{{ route('admin.executive-committees.index') }}"
                        class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">
                        Cancel
                    </a>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Create Committee
                    </button>
                </div>
            </form>
        </div>
    </x-slot>
</x-admin-layout>
