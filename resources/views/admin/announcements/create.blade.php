<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>{{ $announcement ? 'Edit Announcement' : 'Create Announcement' }} | Admin Panel</title>
        @endsection

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    {{ $announcement ? 'Edit Announcement' : 'Create Announcement' }}
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ $announcement ? 'Update announcement details' : 'Add a new announcement' }}
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.announcements.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                    Back to Announcements
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow p-6 dark:bg-gray-800">
            <form method="POST" action="{{ route('admin.announcements.store') }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" value="{{ old('title', $announcement['title'] ?? '') }}"
                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 dark:bg-gray-700 dark:text-white"
                        required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                    <textarea name="message" rows="4"
                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 dark:bg-gray-700 dark:text-white"
                        required>{{ old('message', $announcement['message'] ?? '') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Target URL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Target URL
                        (Optional)</label>
                    <input type="url" name="target_url"
                        value="{{ old('target_url', $announcement['target_url'] ?? '') }}"
                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 dark:bg-gray-700 dark:text-white">
                    @error('target_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status"
                        class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 dark:bg-gray-700 dark:text-white">
                        <option value="1"
                            {{ old('status', $announcement['status'] ?? 1) == 1 ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="0"
                            {{ old('status', $announcement['status'] ?? 1) == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image (Optional)</label>
                    <input type="file" name="image"
                        class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300">
                    @if ($announcement && !empty($announcement['image']))
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Current Image:</p>
                            <img src="{{ asset('storage/' . $announcement['image']) }}" alt="Announcement image"
                                class="mt-2 w-32 h-32 object-cover rounded-md">
                        </div>
                    @endif
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                        {{ $announcement ? 'Update Announcement' : 'Create Announcement' }}
                    </button>
                </div>
            </form>
        </div>
    </x-slot>
</x-admin-layout>
