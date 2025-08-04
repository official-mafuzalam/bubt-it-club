<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Create New Event | BUBT IT Club</title>
        @endsection

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Create New Event
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Fill in the form below to create a new event
                </p>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-6">
                    @include('admin.events.form')
                </div>
                <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-right">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150">
                        Create Event
                    </button>
                </div>
            </form>
        </div>
    </x-slot>
</x-admin-layout>
