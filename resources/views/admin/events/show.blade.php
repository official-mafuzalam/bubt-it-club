<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Event Details | BUBT IT Club</title>
        @endsection

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Event Details: {{ $event->title }}
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    View all details about this event
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.events.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-medium text-gray-800 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                    Back to Events
                </a>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800 p-6 mb-4">
            <div class="flex flex-wrap gap-2 mt-4">
                <a href="{{ route('admin.events.edit', $event->id) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Edit Event</a>

                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this event?')"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Delete
                        Event</button>
                </form>

                <form action="{{ route('admin.events.toggle-publish', $event->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                        {{ $event->is_published ? 'Unpublish' : 'Publish' }}
                    </button>
                </form>

                <form action="{{ route('admin.events.toggle-paid', $event->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                        {{ $event->is_paid ? 'Mark as Free' : 'Mark as Paid' }}
                    </button>
                </form>

                <form action="{{ route('admin.events.toggle-registration', $event->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                        {{ $event->is_registration_open ? 'Close Registration' : 'Open Registration' }}
                    </button>
                </form>

                <form action="{{ route('admin.events.toggle-only-for-members', $event->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                        {{ $event->only_for_members ? 'For Everyone' : 'IT Club Members Only' }}
                    </button>
                </form>

                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'income-add')">
                    {{ __('Add Income') }}
                </x-primary-button>

                <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'expense-add')">
                    {{ __('Add Expense') }}
                </x-danger-button>

            </div>
        </div>

        <!-- Event Details -->
        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Event Image -->
                    <div class="md:col-span-1">
                        @if ($event->image_url)
                            <img src="{{ asset('storage/' . $event->image_url) }}" alt="{{ $event->title }}"
                                class="w-full h-auto rounded-lg shadow">
                        @else
                            <div
                                class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                No Image Available
                            </div>
                        @endif
                    </div>

                    <!-- Event Info -->
                    <div class="md:col-span-2 space-y-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $event->title }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{ $event->category }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Date & Time</h3>
                                <p class="text-gray-800 dark:text-white">
                                    {{ $event->start_date->format('l, F j, Y') }}<br>
                                    {{ $event->start_date->format('h:i A') }} -
                                    {{ $event->end_date->format('h:i A') }}
                                </p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Location</h3>
                                <p class="text-gray-800 dark:text-white">{{ $event->location }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</h3>
                                @php
                                    $statusClasses = [
                                        'upcoming' => 'bg-blue-100 text-blue-800',
                                        'ongoing' => 'bg-green-100 text-green-800',
                                        'completed' => 'bg-gray-100 text-gray-800',
                                    ];
                                    $statusClass =
                                        $statusClasses[strtolower($event->status)] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $event->status }}
                                </span>
                            </div>
                            <div>
                                <a href="{{ route('admin.events.participants', $event->id) }}"
                                    class="text-lg font-medium text-blue-500 dark:text-gray-400 underline">Participants</a>
                                <p class="text-gray-800 dark:text-white">
                                    {{ $event->registrations->count() }} registered
                                    @if ($event->max_participants)
                                        / {{ $event->max_participants }} max
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</h3>
                            <p class="text-gray-800 dark:text-white whitespace-pre-line">{{ $event->description }}</p>
                        </div>

                        <!-- Payment Info -->
                        @if ($event->is_paid)
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Info</h3>
                                <p class="text-gray-800 dark:text-white">Ticket Price: ৳
                                    {{ number_format($event->ticket_price, 2) }}</p>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-2">
                                    @foreach ($event->payment_methods as $method => $details)
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                                {{ ucfirst($method) }}</h4>
                                            <p class="text-gray-800 dark:text-white">Type:
                                                {{ $details['type'] ?? $method }}</p>
                                            <p class="text-gray-800 dark:text-white">Number:
                                                {{ $details['number'] ?? 'N/A' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div> <!-- End Event Info -->
                </div>
            </div>
        </div>

        <!-- Income & Expense Details -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Incomes -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Event Incomes</h3>
                @if ($event->incomes->count())
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                    Category</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                    Amount</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                    Description</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                    Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($event->incomes as $income)
                                <tr>
                                    <td class="px-3 py-2 text-sm text-gray-800 dark:text-gray-200">
                                        {{ $income->incomeCategory->name ?? 'N/A' }}</td>
                                    <td class="px-3 py-2 text-sm text-green-600 dark:text-green-400">
                                        ৳{{ number_format($income->amount, 2) }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-700 dark:text-gray-300">
                                        {{ $income->description }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $income->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 text-right font-semibold text-gray-800 dark:text-white">
                        Total Income: ৳{{ number_format($event->incomes->sum('amount'), 2) }}
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400">No income records found for this event.</p>
                @endif
            </div>

            <!-- Expenses -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Event Expenses</h3>
                @if ($event->expenses->count())
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                    Category</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                    Amount</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                    Description</th>
                                <th
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                    Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($event->expenses as $expense)
                                <tr>
                                    <td class="px-3 py-2 text-sm text-gray-800 dark:text-gray-200">
                                        {{ $expense->expenseCategory->name ?? 'N/A' }}</td>
                                    <td class="px-3 py-2 text-sm text-red-600 dark:text-red-400">
                                        ৳{{ number_format($expense->amount, 2) }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-700 dark:text-gray-300">
                                        {{ $expense->description }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $expense->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 text-right font-semibold text-gray-800 dark:text-white">
                        Total Expense: ৳{{ number_format($event->expenses->sum('amount'), 2) }}
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400">No expense records found for this event.</p>
                @endif
            </div>
        </div>

        <!-- Net Profit/Loss -->
        <div class="mt-6 mb-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow text-right">
            @php
                $net = $event->incomes->sum('amount') - $event->expenses->sum('amount');
            @endphp
            <span
                class="text-lg font-bold {{ $net >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                Net {{ $net >= 0 ? 'Profit' : 'Loss' }}: ৳{{ number_format($net, 2) }}
            </span>
        </div>


        <x-modal name="income-add" :show="$errors->hasBag('incomeStore')" focusable>
            <form method="post" action="{{ route('events.income.store', $event) }}" class="p-6">
                @csrf

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Add Income') }}
                </h2>

                <div class="mt-4">
                    <x-input-label for="income_category_id" :value="__('Income Category')" />
                    <select name="income_category_id" id="income_category_id" class="block w-full mt-1">
                        <option value="">{{ __('Select Category') }}</option>
                        @foreach ($incomeCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->incomeStore->get('income_category_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="amount" :value="__('Amount')" />
                    <x-text-input id="amount" name="amount" type="number" class="block w-full mt-1"
                        step="0.01" />
                    <x-input-error :messages="$errors->incomeStore->get('amount')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea name="description" id="description" class="block w-full mt-1"></textarea>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                    <x-primary-button class="ml-3">{{ __('Save Income') }}</x-primary-button>
                </div>
            </form>
        </x-modal>

        <x-modal name="expense-add" :show="$errors->hasBag('expenseStore')" focusable>
            <form method="post" action="{{ route('events.expense.store', $event) }}" class="p-6">
                @csrf

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Add Expense') }}
                </h2>

                <div class="mt-4">
                    <x-input-label for="expense_category_id" :value="__('Expense Category')" />
                    <select name="expense_category_id" id="expense_category_id" class="block w-full mt-1">
                        <option value="">{{ __('Select Category') }}</option>
                        @foreach ($expenseCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->expenseStore->get('expense_category_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="amount" :value="__('Amount')" />
                    <x-text-input id="amount" name="amount" type="number" class="block w-full mt-1"
                        step="0.01" />
                    <x-input-error :messages="$errors->expenseStore->get('amount')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea name="description" id="description" class="block w-full mt-1"></textarea>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                    <x-primary-button class="ml-3">{{ __('Save Expense') }}</x-primary-button>
                </div>
            </form>
        </x-modal>

    </x-slot>
</x-admin-layout>
