<x-app-layout>
    <x-slot name="main">

        <x-announcement-modal :announcement="$announcement" />

        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="md:w-1/2">
                        <h1 class="text-4xl font-bold leading-tight mb-4">Welcome to BUBT IT Club</h1>
                        <p class="text-xl mb-8">Empowering the future of technology at Bangladesh University of Business
                            and
                            Technology</p>
                        <div class="flex space-x-4">
                            <a href="{{ route('public.events') }}"
                                class="bg-white text-blue-800 px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition duration-300">Explore
                                Events</a>
                            <a href="{{ route('public.about') }}"
                                class="border border-white text-white px-6 py-3 rounded-lg font-medium hover:bg-white hover:text-blue-800 transition duration-300">Learn
                                More</a>
                        </div>
                    </div>
                    <div class="md:w-1/2 mt-8 md:mt-0">
                        <img src="{{ asset('assets/logo.png') }}" alt="IT Club Logo" class="rounded-lg">
                    </div>
                </div>
            </div>
        </header>

        <!-- Features Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">What We Offer</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">We provide a platform for students to enhance
                        their
                        technical skills and collaborate on innovative projects.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                        <div class="text-blue-600 mb-4">
                            <i class="fas fa-laptop-code text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Workshops & Training</h3>
                        <p class="text-gray-600">Regular workshops on programming, web development, AI, and other
                            emerging
                            technologies.</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                        <div class="text-blue-600 mb-4">
                            <i class="fas fa-users text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Tech Community</h3>
                        <p class="text-gray-600">Connect with like-minded students and build a strong professional
                            network.
                        </p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                        <div class="text-blue-600 mb-4">
                            <i class="fas fa-trophy text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Competitions</h3>
                        <p class="text-gray-600">Participate in hackathons, coding contests, and other tech challenges.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Upcoming Events -->
        @if ($events->isNotEmpty())
            <section class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Upcoming Events</h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Join our upcoming events to learn, compete,
                            and
                            network.</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($events as $item)
                            <!-- Event Card 1 -->
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                                <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->title }}"
                                    class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <div class="flex items-center text-sm text-gray-500 mb-2">
                                        <i class="far fa-calendar-alt mr-2"></i>
                                        <span>{{ $item->start_date->format('F j, Y') }}</span>
                                    </div>
                                    <h3 class="text-xl font-semibold mb-2">{{ $item->title }}</h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($item->description, 100) }}</p>
                                    <a href="{{ route('public.events.show', $item->slug) }}"
                                        class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                                        Learn More
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-10">
                        <a href="{{ route('public.events') }}"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            View All Events
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!-- Testimonials -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">What Our Members Say</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Hear from students who have benefited from our
                        programs.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full"
                                    src="https://randomuser.me/api/portraits/women/32.jpg" alt="Testimonial">
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium">Tasnim Ahmed</h4>
                                <p class="text-gray-500">CSE '22</p>
                            </div>
                        </div>
                        <p class="text-gray-600">"The web development workshop helped me land my internship at a top
                            tech
                            company. The hands-on approach was incredibly valuable."</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/men/45.jpg"
                                    alt="Testimonial">
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium">Rakib Hasan</h4>
                                <p class="text-gray-500">SWE '21</p>
                            </div>
                        </div>
                        <p class="text-gray-600">"Participating in the hackathons organized by IT Club gave me the
                            confidence and skills to start my own tech startup."</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full"
                                    src="https://randomuser.me/api/portraits/women/68.jpg" alt="Testimonial">
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium">Farhana Islam</h4>
                                <p class="text-gray-500">CSE '23</p>
                            </div>
                        </div>
                        <p class="text-gray-600">"The networking opportunities through IT Club connected me with alumni
                            working at companies I aspire to join after graduation."</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="py-16 bg-blue-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold mb-6">Ready to Join BUBT IT Club?</h2>
                <p class="text-xl mb-8 max-w-3xl mx-auto">Become part of our growing community of tech enthusiasts and
                    take
                    your skills to the next level.</p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('public.members.register.form') }}"
                        class="bg-white text-blue-800 px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition duration-300">Register
                        Now</a>
                    <a href="{{ route('public.contact') }}"
                        class="border border-white text-white px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-blue-800 transition duration-300">Contact
                        Us</a>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
