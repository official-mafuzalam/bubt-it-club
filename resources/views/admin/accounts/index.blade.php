<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Account Overview | Admin Panel</title>
        @endsection

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Account Overview
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">Summary of incomes and expenses</p>
            </div>
            <div class="mt-4 md:mt-0">
                @can('income')
                    <a href="{{ route('admin.incomes.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                        Income
                    </a>
                @endcan

                @can('expense')
                    <a href="{{ route('admin.expenses.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                        Expense
                    </a>
                @endcan
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Income -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 flex flex-col">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Total Income</h2>
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                    </svg>
                </div>
                <p class="mt-4 text-2xl font-bold text-green-600 dark:text-green-400">
                    {{ number_format($totalIncome, 2) }} ৳
                </p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $incomeCount }} total records</p>
            </div>

            <!-- Total Expense -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 flex flex-col">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Total Expense</h2>
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l-3 3"></path>
                    </svg>
                </div>
                <p class="mt-4 text-2xl font-bold text-red-600 dark:text-red-400">
                    {{ number_format($totalExpense, 2) }} ৳
                </p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $expenseCount }} total records</p>
            </div>

            <!-- Net Balance -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 flex flex-col">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Net Balance</h2>
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                    </svg>
                </div>
                <p class="mt-4 text-2xl font-bold text-blue-600 dark:text-blue-400">
                    {{ number_format($totalIncome - $totalExpense, 2) }} ৳
                </p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Income minus expenses</p>
            </div>

            <!-- Last Updated -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 flex flex-col">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Last Updated</h2>
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                    </svg>
                </div>
                <p class="mt-4 text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                    {{ now()->format('d M Y') }}
                </p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Real-time summary</p>
            </div>
        </div>

        <!-- Optional: You can add a chart or table below -->
        <div class="mt-8">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Recent Transactions</h2>
            <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-4">
                <p class="text-gray-600 dark:text-gray-400">You can add a table or chart here later.</p>
            </div>
        </div>
    </x-slot>
</x-admin-layout>
