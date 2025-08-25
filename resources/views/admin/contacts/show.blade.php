<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Contact Message Details</title>
        @endsection

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Message Details
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    View all information about this message
                </p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <a href="{{ route('admin.contacts.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                    Back to Contacts
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-800 mb-4">📩 Contact Message</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <p class="text-sm font-medium text-gray-500">Name</p>
                        <p class="text-lg text-gray-900">{{ $contact->name }}</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="text-lg text-gray-900">{{ $contact->email }}</p>
                    </div>

                    <!-- Subject -->
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-gray-500">Subject</p>
                        <p class="text-lg text-gray-900">{{ $contact->subject }}</p>
                    </div>

                    <!-- Message -->
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-gray-500">Message</p>
                        <div class="p-4 bg-gray-100 rounded-lg text-gray-800">
                            {{ $contact->message }}
                        </div>
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('admin.contacts.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        ⬅ Back to Messages
                    </a>

                    @switch($contact->is_read)
                        @case(1)
                            <span class="text-sm text-green-500">✔️ Read</span>
                        @break

                        @case(0)
                            <form action="{{ route('admin.contacts.read', $contact->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to mark this message as read?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                    Mark as Read
                                </button>
                            </form>
                        @break

                        @default
                    @endswitch

                </div>
            </div>
        </div>
    </x-slot>
</x-admin-layout>
