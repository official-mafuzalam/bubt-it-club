<x-member-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Dashboard</title>
        @endsection


        <div class="space-y-6">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Projects</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                            Coming soon...
                        </p>
                    </div>
                    <div class="text-blue-500">
                        <i class="fas fa-briefcase fa-2x"></i>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Events</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                            Coming soon...
                        </p>
                    </div>
                    <div class="text-green-500">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                            {{ $member->is_active ? 'Active' : 'Inactive' }}</p>
                    </div>
                    <div class="text-{{ $member->is_active ? 'green' : 'red' }}-500">
                        <i class="fas fa-user-check fa-2x"></i>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events Table -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <h2 class="text-lg font-bold mb-4">Upcoming Events</h2>
                <div class="overflow-x-auto">
                    <table class="w-full table-auto text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="px-4 py-2">Event Name</th>
                                <th class="px-4 py-2">Start</th>
                                <th class="px-4 py-2">End</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($upcomingEvents as $event)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $event->title }}</td>
                                    <td class="px-4 py-2">
                                        {{ $event->start_date->format('d M Y') }} -
                                        {{ $event->start_date->format('h:i A') }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $event->end_date->format('d M Y') }} -
                                        {{ $event->end_date->format('h:i A') }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('members.events.show', $event->id) }}"
                                            class="text-blue-500 hover:underline">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">No
                                        upcoming events found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Social Links -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <h2 class="text-lg font-bold mb-4">Social Links</h2>
                <div class="flex flex-wrap gap-4">
                    @php
                        // Decode the JSON string to an array
                        $socialLinks = json_decode($member->social_links, true) ?? [];
                    @endphp

                    @if (!empty($socialLinks))
                        <div class="mt-4 flex space-x-4">
                            @foreach ($socialLinks as $platform => $link)
                                @if ($link)
                                    <a href="{{ $link }}" target="_blank"
                                        class="text-gray-500 hover:text-blue-500">
                                        <span class="sr-only">{{ ucfirst($platform) }}</span>
                                        @if ($platform == 'facebook')
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @elseif($platform == 'twitter')
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                            </svg>
                                        @elseif($platform == 'linkedin')
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @elseif($platform == 'github')
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </x-slot>
</x-member-layout>
