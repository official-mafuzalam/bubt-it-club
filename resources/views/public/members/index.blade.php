<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">Our Members</h1>
                <p class="text-xl mb-8">Meet the talented members of BUBT IT Club</p>
            </div>
        </header>

        <!-- Members Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Active Members</h2>
                    <div class="mt-4 md:mt-0 flex space-x-4">
                        <select
                            class="px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option>All Batches</option>
                            <option>2023</option>
                            <option>2022</option>
                            <option>2021</option>
                            <option>2020</option>
                        </select>
                        <select
                            class="px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option>All Departments</option>
                            <option>CSE</option>
                            <option>EEE</option>
                            <option>BBA</option>
                        </select>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($members as $member)
                        <div
                            class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition duration-300 text-center">
                            <div class="p-6">
                                <img class="h-32 w-32 rounded-full mx-auto mb-4 border-4 border-blue-100"
                                    src="{{ $member->photo_url ?? 'https://randomuser.me/api/portraits/' . ($member->gender == 'female' ? 'women' : 'men') . '/' . $loop->iteration . '.jpg' }}"
                                    alt="{{ $member->name }}">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $member->name }}</h3>
                                <p class="text-blue-600 mb-1">{{ $member->department }} - Batch {{ $member->batch }}</p>
                                <p class="text-sm text-gray-500 mb-3">{{ $member->position ?? 'Member' }}</p>
                                <div class="flex justify-center space-x-3">
                                    <a href="#" class="text-gray-400 hover:text-blue-600">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-blue-600">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-blue-600">
                                        <i class="fab fa-github"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 text-center">
                                <a href="{{ route('public.members.show', $member->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                    View Profile
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $members->links() }}
                </div>

                <!-- Executive Committee -->
                <div class="mt-16 pt-8 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8">Executive Committee 2023</h2>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ([1, 2, 3, 4, 5, 6] as $executive)
                            <div class="bg-gray-50 p-6 rounded-lg hover:shadow-md transition duration-300">
                                <div class="flex items-start">
                                    <img class="h-16 w-16 rounded-full"
                                        src="https://randomuser.me/api/portraits/{{ $loop->odd ? 'men' : 'women' }}/{{ $executive }}0.jpg"
                                        alt="Executive">
                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold">Executive {{ $executive }}</h3>
                                        <p class="text-blue-600">
                                            {{ ['President', 'Vice President', 'General Secretary', 'Treasurer', 'Event Coordinator', 'PR Officer'][$loop->index] }}
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">CSE Department,
                                            Batch-20{{ 20 + $executive }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Become Member CTA -->
        <section class="py-16 bg-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Want to Become a Member?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">Join our community of tech enthusiasts and
                    enhance your skills through various activities.</p>
                <a href="#"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Apply Now
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </section>
    </x-slot>
</x-app-layout>