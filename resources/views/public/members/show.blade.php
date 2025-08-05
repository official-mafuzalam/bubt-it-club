<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:mr-8 mb-6 md:mb-0">
                        <div class="h-32 w-32 rounded-full overflow-hidden border-4 border-white shadow-lg">
                            @if ($member->photo_url)
                                <img src="{{ asset('storage/' . $member->photo_url) }}" alt="{{ $member->name }}"
                                    class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-4xl text-gray-500"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center md:text-left">
                        <h1 class="text-4xl font-bold mb-2">{{ $member->name }}</h1>
                        <p class="text-xl mb-2">{{ $member->department }} - Batch {{ $member->batch }}</p>
                        @if ($member->position)
                            <p class="text-lg mb-4">{{ $member->position }}</p>
                        @endif
                        <div class="flex flex-wrap justify-center md:justify-start gap-4">
                            @if ($member->email)
                                <a href="mailto:{{ $member->email }}" class="inline-flex items-center text-white">
                                    <i class="fas fa-envelope mr-2"></i> Email
                                </a>
                            @endif
                            @if ($member->phone)
                                <a href="tel:{{ $member->phone }}" class="inline-flex items-center text-white">
                                    <i class="fas fa-phone mr-2"></i> Call
                                </a>
                            @endif
                            @php
                                // Decode the JSON string to an array
                                $socialLinks = json_decode($member->social_links, true) ?? [];
                            @endphp
                            @if (!empty($socialLinks))
                                @foreach ($socialLinks as $platform => $link)
                                    @if ($link)
                                        <a href="{{ $link }}" target="_blank"
                                            class="inline-flex items-center text-white">
                                            <i class="fab fa-{{ $platform }} mr-2"></i> {{ ucfirst($platform) }}
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Member Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <!-- Bio -->
                        <div class="mb-12">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">About</h2>
                            @if ($member->bio)
                                <div class="prose max-w-none">
                                    {!! Str::markdown($member->bio) !!}
                                </div>
                            @else
                                <p class="text-gray-500">No bio available.</p>
                            @endif
                        </div>

                        <!-- Projects -->
                        {{-- <div class="mb-12">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Projects</h2>
                            @if ($member->projects->isNotEmpty())
                                <div class="grid md:grid-cols-2 gap-6">
                                    @foreach ($member->projects as $project)
                                        <div class="border rounded-lg p-4 hover:shadow-md transition duration-300">
                                            <h3 class="text-lg font-semibold mb-2">
                                                <a href="{{ route('public.projects.show', $project) }}"
                                                    class="text-blue-600 hover:text-blue-800">
                                                    {{ $project->title }}
                                                </a>
                                            </h3>
                                            <p class="text-gray-600 text-sm mb-2">
                                                {{ Str::limit($project->description, 100) }}
                                            </p>
                                            <div class="flex flex-wrap gap-2 mt-2">
                                                @foreach ($project->technologies as $tech)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ $tech->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4">
                                    <a href="#"
                                        class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                        View All Projects
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            @else
                                <p class="text-gray-500">No projects available.</p>
                            @endif
                        </div> --}}

                        <!-- Events -->
                        {{-- <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Events Attended</h2>
                            @if ($member->events->isNotEmpty())
                                <div class="space-y-4">
                                    @foreach ($member->events as $event)
                                        <div class="border rounded-lg p-4 hover:shadow-md transition duration-300">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h3 class="text-lg font-semibold mb-1">
                                                        <a href="{{ route('public.events.show', $event) }}"
                                                            class="text-blue-600 hover:text-blue-800">
                                                            {{ $event->title }}
                                                        </a>
                                                    </h3>
                                                    <p class="text-gray-600 text-sm">
                                                        <i class="far fa-calendar-alt mr-2"></i>
                                                        {{ $event->start_date->format('F j, Y') }}
                                                        <span class="mx-2">•</span>
                                                        {{ $event->category }}
                                                    </p>
                                                </div>
                                                @if ($event->pivot->attended)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Attended
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4">
                                    <a href="#"
                                        class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                        View All Events
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            @else
                                <p class="text-gray-500">No events available.</p>
                            @endif
                        </div> --}}
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Academic Information -->
                        <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Academic Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Student ID</h4>
                                    <p class="text-gray-900">{{ $member->student_id }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Department</h4>
                                    <p class="text-gray-900">
                                        @switch($member->department)
                                            @case('CSE')
                                                Computer Science & Engineering
                                            @break

                                            @case('EEE')
                                                Electrical & Electronic Engineering
                                            @break

                                            @case('BBA')
                                                Business Administration
                                            @break

                                            @case('MBA')
                                                Masters of Business Administration
                                            @break

                                            @default
                                                {{ $member->department }}
                                        @endswitch
                                    </p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Batch</h4>
                                    <p class="text-gray-900">{{ $member->batch }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Member Since</h4>
                                    <p class="text-gray-900">{{ $member->joined_at->format('F Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Contact Information</h3>
                            <div class="space-y-4">
                                @if ($member->email)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Email</h4>
                                        <p class="text-gray-900">
                                            <a href="mailto:{{ $member->email }}"
                                                class="text-blue-600 hover:text-blue-800">
                                                {{ $member->email }}
                                            </a>
                                        </p>
                                    </div>
                                @endif
                                @if ($member->phone)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Phone</h4>
                                        <p class="text-gray-900">
                                            <a href="tel:{{ $member->phone }}"
                                                class="text-blue-600 hover:text-blue-800">
                                                {{ $member->phone }}
                                            </a>
                                        </p>
                                    </div>
                                @endif
                                @if ($member->social_links)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 mb-2">Social Media</h4>
                                        <div class="flex space-x-4">
                                            @foreach ($member->social_links as $platform => $url)
                                                @if ($url)
                                                    <a href="{{ $url }}" target="_blank"
                                                        class="text-gray-600 hover:text-blue-600">
                                                        <i class="fab fa-{{ $platform }} text-2xl"></i>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Skills/Interests -->
                        @if ($member->favorite_categories && count($member->favorite_categories) > 0)
                            <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Interests</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($member->favorite_categories as $category)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $category }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
