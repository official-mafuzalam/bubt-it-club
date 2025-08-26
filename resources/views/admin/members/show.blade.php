<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>{{ $member->name }} | BUBT IT Club</title>
        @endsection

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Member Details
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    View all information about {{ $member->name }}
                </p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <a href="{{ route('admin.members.executive', $member->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-150">
                    Add To Executive
                </a>
                <a href="{{ route('admin.members.edit', $member->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-150">
                    Edit Member
                </a>
                <a href="{{ route('admin.members.email-confirmation', $member->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150">
                    Resend Email
                </a>
                <form action="{{ route('admin.members.password.reset', $member->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-150">
                        Reset Password
                    </button>
                </form>
                <form action="{{ route('admin.members.toggle-activation', $member->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 {{ $member->is_active ? 'bg-gray-600 hover:bg-gray-700 focus:ring-gray-500' : 'bg-green-600 hover:bg-green-700 focus:ring-green-500' }} border border-transparent rounded-md font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-150">
                        {{ $member->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>
                <form action="{{ route('admin.members.add-to-user', $member->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-colors duration-150">
                        Add To User
                    </button>
                </form>
                <a href="{{ route('admin.members.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                    Back to Members
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Profile Section -->
                    <div class="md:col-span-1">
                        <div class="flex flex-col items-center">
                            @if ($member->photo_url)
                                <img class="h-32 w-32 rounded-full object-cover mb-4"
                                    src="{{ asset('storage/' . $member->photo_url) }}" alt="{{ $member->name }}">
                            @else
                                <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center mb-4">
                                    <span
                                        class="text-4xl text-gray-500">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                </div>
                            @endif

                            <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                                {{ $member->name }}
                            </h2>

                            @if ($member->position)
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $member->position }}
                                </p>
                            @endif

                            <div class="mt-4 flex space-x-4">
                                <div class="flex flex-wrap justify-center md:justify-start gap-4">
                                    @if ($member->email)
                                        <a href="mailto:{{ $member->email }}"
                                            class="inline-flex items-center text-gray-500 hover:text-blue-500">
                                            <i class="fas fa-envelope mr-2"></i>
                                        </a>
                                    @endif
                                    @if ($member->phone)
                                        <a href="tel:{{ $member->phone }}"
                                            class="inline-flex items-center text-gray-500 hover:text-blue-500">
                                            <i class="fas fa-phone mr-2"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4 flex space-x-4">
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

                    <!-- Information Section -->
                    <div class="md:col-span-2">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Personal Information -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2">
                                    Personal Information
                                </h3>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $member->email }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $member->phone ?? 'N/A' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Gender</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white capitalize">
                                        {{ $member->gender }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Joined Date</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $member->joined_at->format('d M Y') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $member->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $member->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Academic Information -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2">
                                    Academic Information
                                </h3>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Student ID</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $member->student_id }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Department</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $member->department }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Intake</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $member->intake }}
                                    </p>
                                </div>

                                {{-- <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Batch Year</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $member->batch_year }}
                                    </p>
                                </div> --}}
                            </div>
                        </div>

                        <!-- Bio Section -->
                        @if ($member->bio)
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2">
                                    Bio
                                </h3>
                                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">
                                    {{ $member->bio }}
                                </p>
                            </div>
                        @endif

                        <!-- Favorite Categories Section -->
                        @php
                            $favoriteCategories = is_array($member->favorite_categories)
                                ? $member->favorite_categories
                                : json_decode($member->favorite_categories, true) ?? [];
                        @endphp
                        @if (!empty($favoriteCategories))
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2">
                                    Favorite Categories
                                </h3>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach ($favoriteCategories as $category)
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ $category }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects Section -->
        {{-- <div class="mt-6 bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    Projects ({{ $member->projects->count() }})
                </h3>
            </div>
            <div class="overflow-x-auto">
                @if ($member->projects->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Project
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contribution
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Joined At
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach ($member->projects as $project)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if ($project->image_url)
                                                    <img class="h-10 w-10 rounded-full object-cover"
                                                        src="{{ asset('storage/' . $project->image_url) }}"
                                                        alt="{{ $project->name }}">
                                                @else
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <span
                                                            class="text-gray-500">{{ strtoupper(substr($project->name, 0, 1)) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $project->name }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $project->status }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white capitalize">
                                            {{ $project->pivot->role }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $project->pivot->contribution ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $project->pivot->created_at->format('d M Y') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">
                        This member hasn't participated in any projects yet.
                    </div>
                @endif
            </div>
        </div> --}}

        <!-- Events Section -->
        {{-- <div class="mt-6 bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    Events ({{ $member->events->count() }})
                </h3>
            </div>
            <div class="overflow-x-auto">
                @if ($member->events->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Event
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Attended
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach ($member->events as $event)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if ($event->image_url)
                                                    <img class="h-10 w-10 rounded-full object-cover"
                                                        src="{{ asset('storage/' . $event->image_url) }}"
                                                        alt="{{ $event->title }}">
                                                @else
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <span
                                                            class="text-gray-500">{{ strtoupper(substr($event->title, 0, 1)) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $event->title }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $event->location }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $event->start_date->format('d M Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $event->start_date->format('h:i A') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white capitalize">
                                            {{ $event->pivot->role }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($event->pivot->attended)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Yes
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                No
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">
                        This member hasn't participated in any events yet.
                    </div>
                @endif
            </div>
        </div> --}}
    </x-slot>
</x-admin-layout>
