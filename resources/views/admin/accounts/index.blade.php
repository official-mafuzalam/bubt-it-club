<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Accounts | Admin Panel</title>
        @endsection

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Accounts
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Manage all accounts in the system
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.incomes.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                    Income
                </a>
                <a href="{{ route('admin.expenses.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                    Expense
                </a>
                {{-- <a href="{{ route('admin.blog.posts.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150">
                    Add New Post
                </a> --}}
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            
        </div>
    </x-slot>
</x-admin-layout>
