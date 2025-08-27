<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Events Register</title>
        @endsection

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Events Register
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    View and manage all event registrations
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.events.show', $event->id) }}"
                    class="inline-block px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    Back to Events
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow mb-6 dark:bg-gray-800">
            <div class="p-4">
                <form action="{{ route('admin.events.participants', $event) }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="date_from" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            From Date
                        </label>
                        <input type="date" id="date_from" name="date_from" onclick="this.showPicker()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ request('date_from') }}">
                    </div>
                    <div>
                        <label for="date_to" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            To Date
                        </label>
                        <input type="date" id="date_to" name="date_to" onclick="this.showPicker()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ request('date_to') }}">
                    </div>
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Status
                        </label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">All Statuses</option>
                            <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Upcoming
                            </option>
                            <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Ongoing
                            </option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>
                                Completed</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full h-[42px] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (request()->filled('date_from') || request()->filled('date_to') || request()->filled('status'))
            <div class="mb-4 p-3 bg-blue-50 rounded-lg dark:bg-gray-700">
                <p class="text-sm text-gray-800 dark:text-gray-300">
                    Showing results for:
                    @if (request('date_from') && request('date_to'))
                        from <span class="font-semibold">{{ request('date_from') }}</span>
                        to <span class="font-semibold">{{ request('date_to') }}</span>
                    @elseif(request('date_from'))
                        after <span class="font-semibold">{{ request('date_from') }}</span>
                    @elseif(request('date_to'))
                        before <span class="font-semibold">{{ request('date_to') }}</span>
                    @endif
                    @if (request('status'))
                        with status: <span class="font-semibold capitalize">{{ request('status') }}</span>
                    @endif
                </p>
            </div>
        @endif

        <!-- Events Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Table Headers -->
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Student Info
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Academic Info
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Payment Info
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($registrations as $registration)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $registration->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $registration->email }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $registration->phone }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $registration->student_id }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        Department of: {{ $registration->department }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        Intake: {{ $registration->intake }}/{{ $registration->section }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        @switch($registration->payment_method)
                                            @case('hand_cash')
                                                <span>Hand Cash</span>
                                            @break

                                            @case('nagad')
                                                <span>Nagad</span>
                                            @break

                                            @case('bkash')
                                                <span>bKash</span>
                                            @break

                                            @default
                                                <span>Other</span>
                                        @endswitch
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $registration->transaction_id ?? 'N/A' }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $registration->created_at->format('d M Y') }}
                                        {{ $registration->created_at->format('h:i A') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        @switch($registration->attended)
                                            @case(0)
                                                <span>Not Attended</span>
                                            @break

                                            @case(1)
                                                <span>Attended</span>
                                            @break

                                            @default
                                                <span>Unknown</span>
                                        @endswitch
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.events.confirm-email', $registration->id) }}"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        Sent Mail
                                    </a>
                                    @if ($registration->attended == 0)
                                        <form action="{{ route('admin.events.attendance', $registration->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                                Mark Attendance
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.events.cancel', $registration->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to cancel this registration?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                            Cancel Registration
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No events found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{-- {{ $events->links() }} --}}
                </div>
            </div>
        </x-slot>
    </x-admin-layout>
