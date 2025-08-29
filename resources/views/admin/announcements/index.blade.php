<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Announcements | Admin Panel</title>
        @endsection

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Announcement</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Manage the single announcement in the system.
                </p>
            </div>
            @can('announcement_create')
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('admin.announcements.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-md text-white font-medium hover:bg-blue-700 focus:outline-none">
                        {{ $announcement ? 'Edit Announcement' : 'Create Announcement' }}
                    </a>
                </div>
            @endcan
        </div>

        @if ($announcement)
            <!-- Announcement Card -->
            <div class="bg-white shadow rounded-lg p-6 dark:bg-gray-800 space-y-4">
                @if (!empty($announcement['image']))
                    <img src="{{ asset('storage/' . $announcement['image']) }}" alt="Announcement Image"
                        class="w-full max-h-64 object-cover rounded-lg">
                @endif

                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $announcement['title'] }}</h2>
                    <form method="POST" action="{{ route('admin.announcements.toggle-status') }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="px-3 py-1 rounded-full text-xs font-medium
                                   {{ $announcement['status']
                                       ? 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-white'
                                       : 'bg-red-100 text-red-800 dark:bg-red-700 dark:text-white' }}">
                            {{ $announcement['status'] ? 'Active' : 'Inactive' }}
                        </button>
                    </form>
                </div>

                <p class="text-gray-700 dark:text-gray-300">{{ $announcement['message'] }}</p>

                @if (!empty($announcement['target_url']))
                    <a href="{{ $announcement['target_url'] }}" target="_blank"
                        class="text-blue-600 hover:underline dark:text-blue-400">
                        Go to link
                    </a>
                @endif

                @can('announcement_create')
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.announcements.create') }}"
                            class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                            Edit
                        </a>
                    </div>
                @endcan

                <p class="text-sm text-gray-500 dark:text-gray-400">Created at: {{ $announcement['created_at'] }}</p>
            </div>
        @else
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg text-center text-gray-500 dark:text-gray-300">
                No announcement found. Click "Create Announcement" to add one.
            </div>
        @endif
    </x-slot>
</x-admin-layout>
