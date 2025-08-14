<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section with Event Title -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="max-w-3xl mx-auto">
                    <h1 class="text-4xl font-bold leading-tight mb-4">{{ $event->title }}</h1>
                    <div class="flex flex-wrap justify-center items-center gap-4 mt-6">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($event->category) }}
                        </span>
                        <span class="inline-flex items-center text-white">
                            <i class="far fa-calendar-alt mr-2"></i>
                            {{ $event->start_date->format('F j, Y') }}
                        </span>
                        <span class="inline-flex items-center text-white">
                            <i class="far fa-clock mr-2"></i>
                            {{ $event->start_date->format('h:i A') }} - {{ $event->end_date->format('h:i A') }}
                        </span>
                        <span class="inline-flex items-center text-white">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $event->location }}
                        </span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Event Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <!-- Event Image -->
                        <div class="rounded-lg overflow-hidden shadow-lg mb-8">
                            @if ($event->image_url)
                                <img src="{{ asset('storage/' . $event->image_url) }}" alt="{{ $event->title }}"
                                    class="w-full h-auto object-cover">
                            @else
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">Event Image</span>
                                </div>
                            @endif
                        </div>

                        <!-- Event Description -->
                        <div class="prose max-w-none">
                            {!! Str::markdown($event->description) !!}
                        </div>

                        <!-- Event Schedule (if available) -->
                        @if ($event->schedule)
                            <div class="mt-12">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6">Event Schedule</h3>
                                <div class="bg-gray-50 rounded-lg p-6">
                                    {!! Str::markdown($event->schedule) !!}
                                </div>
                            </div>
                        @endif

                        <!-- Speakers/Guests (if available) -->
                        @if ($event->speakers)
                            <div class="mt-12">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6">Speakers & Guests</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach (json_decode($event->speakers) as $speaker)
                                        <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                                            @if ($speaker->photo)
                                                <img src="{{ asset('storage/' . $speaker->photo) }}"
                                                    alt="{{ $speaker->name }}"
                                                    class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                                            @endif
                                            <h4 class="text-lg font-semibold">{{ $speaker->name }}</h4>
                                            <p class="text-gray-600 text-sm">{{ $speaker->title }}</p>
                                            <p class="text-gray-500 text-xs mt-2">{{ $speaker->organization }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Registration Panel -->
                        @if ($event->is_registration_open)
                            <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Event Registration</h3>

                                @if ($event->start_date < now())
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                                        <p class="text-yellow-700">This event has already occurred</p>
                                    </div>
                                @elseif($event->max_participants && $event->registrations()->count() >= $event->max_participants)
                                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                                        <p class="text-red-700">This event is fully booked</p>
                                    </div>
                                @else
                                    <p class="text-gray-600 mb-4">
                                        @if ($event->max_participants)
                                            {{ $event->max_participants - $event->registrations()->count() }} spots
                                            remaining
                                        @else
                                            Unlimited seats available
                                        @endif
                                    </p>

                                    <a href="{{ route('public.events.register', $event->id) }}"
                                        class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700">
                                        Register Now
                                    </a>
                                @endif

                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <p class="text-sm text-gray-500">
                                        <i class="fas fa-users mr-2"></i>
                                        {{ $event->registrations()->count() }} registered
                                        @if ($event->max_participants)
                                            of {{ $event->max_participants }} total
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Event Details Card -->
                        <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Event Details</h3>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Date</h4>
                                    <p class="text-gray-900">{{ $event->start_date->format('l, F j, Y') }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Time</h4>
                                    <p class="text-gray-900">{{ $event->start_date->format('h:i A') }} -
                                        {{ $event->end_date->format('h:i A') }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Location</h4>
                                    <p class="text-gray-900">{{ $event->location }}</p>
                                    @if ($event->map_link)
                                        <div class="mt-2">
                                            <a href="{{ $event->map_link }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800 text-sm inline-flex items-center">
                                                View on map <i class="fas fa-external-link-alt ml-1"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Category</h4>
                                    <p class="text-gray-900 capitalize">{{ $event->category }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Share Event -->
                        <div class="bg-gray-50 rounded-lg shadow-sm p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Share This Event</h3>
                            <div class="flex space-x-4">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                    target="_blank" class="text-gray-600 hover:text-blue-600">
                                    <i class="fab fa-facebook-f text-2xl"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($event->title) }}&url={{ urlencode(url()->current()) }}"
                                    target="_blank" class="text-gray-600 hover:text-blue-400">
                                    <i class="fab fa-twitter text-2xl"></i>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($event->title) }}&summary={{ urlencode(Str::limit(strip_tags($event->description), 100)) }}"
                                    target="_blank" class="text-gray-600 hover:text-blue-700">
                                    <i class="fab fa-linkedin-in text-2xl"></i>
                                </a>
                                <a href="mailto:?subject={{ rawurlencode($event->title) }}&body={{ rawurlencode('Check out this event: ' . url()->current()) }}"
                                    class="text-gray-600 hover:text-red-500">
                                    <i class="fas fa-envelope text-2xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Events -->
                @if ($relatedEvents->isNotEmpty())
                    <div class="mt-16 pt-12 border-t border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-8">More {{ ucfirst($event->category) }} Events
                        </h3>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($relatedEvents as $relatedEvent)
                                <div
                                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 border border-gray-100">
                                    <div class="relative">
                                        @if ($relatedEvent->image_url)
                                            <img src="{{ asset('storage/' . $relatedEvent->image_url) }}"
                                                alt="{{ $relatedEvent->title }}" class="w-full h-48 object-cover">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                                                alt="Default event image" class="w-full h-48 object-cover">
                                        @endif
                                        <div
                                            class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium capitalize">
                                            {{ $relatedEvent->category }}
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-center text-sm text-gray-500 mb-2">
                                            <i class="far fa-calendar-alt mr-2"></i>
                                            <span>{{ $relatedEvent->start_date->format('F j, Y') }}</span>
                                        </div>
                                        <h4 class="text-xl font-semibold mb-2">{{ $relatedEvent->title }}</h4>
                                        <p class="text-gray-600 mb-4">
                                            {{ Str::limit($relatedEvent->description, 100) }}</p>
                                        <a href="{{ route('public.events.show', $relatedEvent->id) }}"
                                            class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                                            View Details
                                            <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </x-slot>
</x-app-layout>
