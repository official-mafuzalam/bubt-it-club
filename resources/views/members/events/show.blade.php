<x-member-layout>
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
                <a href="{{ route('members.events.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-800 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                    Back to Events
                </a>
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

                    <!-- Event Details -->
                    <div class="md:col-span-2">
                        <div class="space-y-4">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $event->title }}</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{ $event->category }}
                                </p>
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
                                    <p class="text-xl font-medium text-gray-500 dark:text-gray-400">Participants</p>
                                    <p class="text-gray-800 dark:text-white">
                                        {{ $event->registrations->count() }} registered
                                        @if ($event->max_participants)
                                            / {{ $event->max_participants }} max
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</h3>
                                <p class="text-gray-800 dark:text-white whitespace-pre-line">{{ $event->description }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                @if ($event->registrations->contains('email', $member->email))
                                    <p class="text-2xl text-red-500 dark:text-gray-400">You are registered for this
                                        event.</p>
                                @else
                                    <form action="{{ route('members.events.register', $event->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to register for this event?')"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-150">
                                            Register for Event
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </x-slot>
</x-member-layout>
