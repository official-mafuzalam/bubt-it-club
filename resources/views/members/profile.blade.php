<x-member-layout>
    <x-slot name="main">

        <div class="max-w-4xl mx-auto space-y-6">

            <!--- Profile Edit Button -->
            <div class="flex justify-end">
                <a href="{{ route('members.profile.edit') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Edit Profile
                </a>
            </div>

            <!-- Profile Header -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow flex items-center space-x-6">
                <img src="{{ $member->photo_url ? asset('storage/' . $member->photo_url) : 'https://ui-avatars.com/api/?name=' . $member->name }}"
                    alt="Avatar" class="w-24 h-24 rounded-full border border-gray-300 dark:border-gray-600">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $member->name }}</h2>
                    <p class="text-gray-500 dark:text-gray-400">{{ $member->position }}
                        @if ($member->executiveCommittee)
                            ({{ $member->executiveCommittee->name }})
                        @endif
                    </p>
                    <p class="text-gray-500 dark:text-gray-400">Joined: {{ $member->joined_at->format('d M, Y') }}</p>
                    <p class="text-gray-500 dark:text-gray-400">Status: {{ $member->is_active ? 'Active' : 'Inactive' }}
                    </p>
                </div>
            </div>

            <!-- Basic Info -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow space-y-4">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Name</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $member->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Email</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $member->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Student ID</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $member->student_id }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Department</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $member->department }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Intake</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $member->intake }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Phone</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $member->phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Gender</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ ucfirst($member->gender) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Contact Info Visibility</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">
                            {{ $member->contact_public ? 'Public' : 'Private' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Social Links Visibility</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">
                            {{ $member->social_links_public ? 'Public' : 'Private' }}</p>
                    </div>
                </div>
            </div>

            <!-- Bio -->
            @if ($member->bio)
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Bio</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $member->bio }}</p>
                </div>
            @endif

            <!-- Favorite Categories -->
            @if ($member->favorite_categories)
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Favorite Categories</h3>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @php
                            $favoriteCategories = is_array($member->favorite_categories)
                                ? $member->favorite_categories
                                : json_decode($member->favorite_categories, true) ?? [];
                        @endphp
                        @if (!empty($favoriteCategories))
                            <div class="mt-2 flex flex-wrap gap-2">
                                @foreach ($favoriteCategories as $category)
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $category }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Social Links -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Social Links</h3>
                <div class="flex flex-wrap gap-4 mt-2">
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
