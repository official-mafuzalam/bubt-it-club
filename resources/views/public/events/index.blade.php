<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">Our Events</h1>
                <p class="text-xl mb-8">Discover upcoming workshops, seminars, and competitions</p>
            </div>
        </header>

        <!-- Events Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Upcoming Events</h2>
                    <div class="mt-4 md:mt-0">
                        <select
                            class="px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option>All Categories</option>
                            <option>Workshop</option>
                            <option>Seminar</option>
                            <option>Hackathon</option>
                            <option>Competition</option>
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($events as $event)
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 border border-gray-100">
                            <div class="relative">
                                <img src="{{ $event->image_url ?? 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80' }}"
                                    alt="{{ $event->title }}" class="w-full h-48 object-cover">
                                <div
                                    class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $event->category }}
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <span>{{ $event->event_date->format('F j, Y') }}</span>
                                    <span class="mx-2">•</span>
                                    <i class="far fa-clock mr-2"></i>
                                    <span>{{ $event->event_time }}</span>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">{{ $event->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($event->description, 100) }}</p>
                                <div class="flex justify-between items-center">
                                    <a href="{{ route('public.events.show', $event->id) }}"
                                        class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                                        View Details
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-users mr-1"></i>
                                        {{ $event->registered_count }} Registered
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $events->links() }}
                </div>

                <!-- Past Events -->
                <div class="mt-16 pt-8 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8">Past Events</h2>

                    <div class="space-y-6">
                        @foreach ([1, 2, 3] as $pastEvent)
                            <div class="bg-gray-50 p-6 rounded-lg hover:bg-gray-100 transition duration-300">
                                <div class="md:flex md:items-center md:justify-between">
                                    <div class="md:w-3/4">
                                        <h3 class="text-lg font-semibold text-gray-900">Past Event Title
                                            {{ $pastEvent }}</h3>
                                        <div class="flex items-center text-sm text-gray-500 mt-1">
                                            <i class="far fa-calendar-alt mr-2"></i>
                                            <span>June {{ 10 + $pastEvent }}, 2023</span>
                                            <span class="mx-2">•</span>
                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                            <span>BUBT Campus</span>
                                        </div>
                                    </div>
                                    <div class="mt-4 md:mt-0">
                                        <a href="#"
                                            class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                            View Gallery
                                            <i class="fas fa-images ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-8">
                        <a href="#"
                            class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                            View All Past Events
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
