<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">About BUBT IT Club</h1>
                <p class="text-xl mb-8">
                    Empowering the future of technology at Bangladesh University of Business and Technology
                </p>
            </div>
        </header>

        <!-- About Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="md:flex md:items-center md:space-x-12">
                    <div class="md:w-1/2 mb-8 md:mb-0">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1471&q=80"
                            alt="IT Club Team" class="rounded-lg shadow-xl">
                    </div>
                    <div class="md:w-1/2">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                        <p class="text-lg text-gray-600 mb-6">
                            BUBT IT CLUB started its munificent journey in September 2011. The main purpose is to
                            coherently distribute IT knowledge among students of all disciplines, conducting workshops,
                            competitions, and creative events to enhance skills and practical understanding.
                        </p>

                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Our Vision</h3>
                        <p class="text-lg text-gray-600 mb-6">
                            To create a vibrant community of tech enthusiasts who drive innovation and contribute to the
                            digital transformation of Bangladesh.
                        </p>

                        <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-600">
                            <h4 class="text-xl font-semibold text-blue-800 mb-3">Club Established</h4>
                            <p class="text-gray-700">
                                Since 2011, BUBT IT Club has been nurturing tech talent with numerous activities,
                                workshops, and competitions. All activities are self-financed and organized by students
                                with guidance from faculty.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Leadership Team -->
        @if ($currentExecutive)
            <section class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Leadership Team</h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Meet the dedicated students who guide the IT Club
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach ($currentExecutive->members as $member)
                            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                                <img class="h-32 w-32 rounded-full mx-auto mb-4 object-cover"
                                    src="{{ $member->photo_url ? asset('storage/' . $member->photo_url) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) }}"
                                    alt="{{ $member->name }}">
                                <a href="{{ route('public.members.show', $member->id) }}"
                                    class="text-xl text-blue-500 font-semibold mb-1 block">{{ $member->name }}</a>
                                <p class="text-blue-600 mb-2">{{ $member->position }}</p>
                                <p class="text-gray-600">{{ $member->department }}, Batch-{{ $member->intake }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Achievements -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Achievements</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Proud moments in our journey</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 text-center">
                    <div class="p-6">
                        <div class="text-5xl font-bold text-blue-600 mb-4">50+</div>
                        <h3 class="text-xl font-semibold mb-2">Workshops Conducted</h3>
                        <p class="text-gray-600">On various cutting-edge technologies</p>
                    </div>
                    <div class="p-6">
                        <div class="text-5xl font-bold text-blue-600 mb-4">20+</div>
                        <h3 class="text-xl font-semibold mb-2">Hackathons Organized</h3>
                        <p class="text-gray-600">With industry partners</p>
                    </div>
                    <div class="p-6">
                        <div class="text-5xl font-bold text-blue-600 mb-4">100+</div>
                        <h3 class="text-xl font-semibold mb-2">Projects Completed</h3>
                        <p class="text-gray-600">By our talented members</p>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
