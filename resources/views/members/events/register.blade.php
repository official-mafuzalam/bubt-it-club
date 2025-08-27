<x-member-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Event Registration | BUBT IT Club</title>
        @endsection

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Register for Event: {{ $event->title }}
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Fill in your details to participate in this event
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('members.events.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-800 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                    Back to Events
                </a>
            </div>
        </div>

        <!-- Event Registration Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            @if (session('error'))
                <div class="mb-4 p-4 text-red-800 bg-red-100 rounded">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('members.events.register', $event->slug) }}" method="POST" class="space-y-6">
                @csrf

                @if ($event->is_paid)
                    <div class="border-t pt-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Payment Information: Ticket Price {{ $event->ticket_price }}</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment
                                    Method</label>

                                <select name="payment_method" id="payment_method"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    @php
                                        $methods = $event->payment_methods ?? [];
                                    @endphp

                                    <!-- Loop through saved payment methods -->
                                    @foreach ($methods as $method)
                                        <option value="{{ $method['type'] }}"
                                            {{ old('payment_method') == $method['type'] ? 'selected' : '' }}>
                                            {{ ucfirst($method['type']) }} - {{ $method['number'] }}
                                        </option>
                                    @endforeach

                                    <!-- Add Hand Cash option -->
                                    <option value="hand_cash"
                                        {{ old('payment_method') == 'hand_cash' ? 'selected' : '' }}>
                                        Hand Cash
                                    </option>
                                </select>

                                @error('payment_method')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment
                                    Amount</label>
                                <input type="text" name="payment_amount" value="{{ old('payment_amount') }}"
                                    class="mt-1 block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('payment_amount') border-red-500 @enderror">
                                @error('payment_amount')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Transaction
                                ID</label>
                            <input type="text" name="transaction_id" value="{{ old('transaction_id') }}"
                                class="mt-1 block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('transaction_id') border-red-500 @enderror">
                            @error('transaction_id')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endif

                <!-- Additional Info -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Additional Info
                        (Optional)</label>
                    <textarea name="additional_info" rows="3"
                        class="mt-1 block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('additional_info') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150">
                        Register Now
                    </button>
                </div>
            </form>
        </div>
    </x-slot>
</x-member-layout>
