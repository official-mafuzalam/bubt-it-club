<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">{{ $pageTitle }}</h1>
                <p class="text-xl mb-8">{{ $pageDescription }}</p>
            </div>
        </header>

        <!-- Events Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Upcoming Events -->
                <div class="mb-16">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">Upcoming Events</h2>
                        <div class="mt-4 md:mt-0">
                            <select id="category-filter"
                                class="px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Categories</option>
                                <option value="workshop">Workshop</option>
                                <option value="seminar">Seminar</option>
                                <option value="hackathon">Hackathon</option>
                                <option value="competition">Competition</option>
                            </select>
                        </div>
                    </div>

                    @if ($events->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500">No upcoming events at the moment. Please check back later.</p>
                        </div>
                    @else
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($events as $event)
                                <div
                                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 border border-gray-100">
                                    <div class="relative">
                                        @if ($event->image_url)
                                            <img src="{{ asset('storage/' . $event->image_url) }}"
                                                alt="{{ $event->title }}" class="w-full h-48 object-cover">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                                                alt="Default event image" class="w-full h-48 object-cover">
                                        @endif
                                        <div
                                            class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium capitalize">
                                            {{ $event->category }}
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-center text-sm text-gray-500 mb-2">
                                            <i class="far fa-calendar-alt mr-2"></i>
                                            <span>{{ $event->start_date->format('F j, Y') }}</span>
                                            <span class="mx-2">•</span>
                                            <i class="far fa-clock mr-2"></i>
                                            <span>{{ $event->start_date->format('h:i A') }}</span>
                                        </div>
                                        <h3 class="text-xl font-semibold mb-2">{{ $event->title }}</h3>
                                        <p class="text-gray-600 mb-4">{{ Str::limit($event->description, 100) }}</p>
                                        <div class="flex justify-between items-center">
                                            <a href="#"
                                                class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                                                View Details
                                                <i class="fas fa-arrow-right ml-2"></i>
                                            </a>
                                            @if ($event->max_participants)
                                                <span class="text-sm text-gray-500">
                                                    <i class="fas fa-users mr-1"></i>
                                                    0 /
                                                    {{ $event->max_participants }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $events->links() }}
                        </div>
                    @endif
                </div>

                <!-- Past Events -->
                @if ($pastEvents->isNotEmpty())
                    <div class="pt-8 border-t border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">Past Events</h2>

                        <div class="space-y-6">
                            @foreach ($pastEvents as $event)
                                <div class="bg-gray-50 p-6 rounded-lg hover:bg-gray-100 transition duration-300">
                                    <div class="md:flex md:items-center md:justify-between">
                                        <div class="md:w-3/4">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $event->title }}</h3>
                                            <div class="flex items-center text-sm text-gray-500 mt-1">
                                                <i class="far fa-calendar-alt mr-2"></i>
                                                <span>{{ $event->start_date->format('F j, Y') }}</span>
                                                <span class="mx-2">•</span>
                                                <i class="fas fa-map-marker-alt mr-2"></i>
                                                <span>{{ $event->location }}</span>
                                            </div>
                                        </div>
                                        <div class="mt-4 md:mt-0">
                                            <a href="#"
                                                class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                                View Details
                                                <i class="fas fa-arrow-right ml-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-center mt-8">
                            <a href="{{ route('public.events.archive') }}"
                                class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                View All Past Events
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        @push('scripts')
            <script>
                // Category filter functionality
                document.getElementById('category-filter').addEventListener('change', function() {
                    const category = this.value;
                    window.location.href = "{{ route('public.events') }}" + (category ? `?category=${category}` :
                    '');
                });
            </script>
        @endpush
    </x-slot>
</x-app-layout>