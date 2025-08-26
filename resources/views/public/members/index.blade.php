<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">Our Members</h1>
                <p class="text-xl mb-4">Meet the talented members of BUBT IT Club</p>
                <a href="{{ route('public.members.register.form') }}"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-700">
                    Apply Now
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </header>

        <!-- Members Content -->
        <section class="py-10 bg-white">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                @foreach ($executiveCommittees as $item)
                    <div class="bg-gray-50 p-6 rounded-lg mb-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $item->description }}</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($item->members as $executive)
                            <div class="bg-gray-50 p-6 rounded-lg hover:shadow-md transition duration-300">
                                <div class="flex items-start">
                                    <img class="h-16 w-16 rounded-full"
                                        src="{{ $executive->contact_public == 1 && $executive->photo_url
                                            ? asset('storage/' . $executive->photo_url)
                                            : 'https://ui-avatars.com/api/?name=' . urlencode($executive->name) }}"
                                        alt="Executive">

                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold">{{ $executive->name }}</h3>
                                        <p class="text-blue-600">
                                            {{ $executive->position ?? 'Member' }}
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">{{ $executive->department }},
                                            Intake {{ $executive->intake }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <!-- All Members Section -->
                <!-- Filters -->
                <div class="bg-gray-50 rounded-lg shadow mb-6 p-4 mt-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">All Members</h3>
                    <form action="{{ route('public.members.index') }}" method="GET"
                        class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="department"
                                class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <select id="department" name="department"
                                class="w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">All Departments</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept }}"
                                        {{ request('department') == $dept ? 'selected' : '' }}>
                                        {{ $dept }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="batch" class="block text-sm font-medium text-gray-700 mb-1">Batch</label>
                            <select id="intake" name="intake" class="w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">All Intakes</option>
                                @foreach ($intakes as $intake)
                                    <option value="{{ $intake }}"
                                        {{ request('intake') == $intake ? 'selected' : '' }}>
                                        {{ $intake }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Members Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($members as $member)
                        <div
                            class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                            <div class="p-6 text-center">
                                <div
                                    class="mx-auto h-32 w-32 rounded-full overflow-hidden border-4 border-blue-100 mb-4">
                                    @if ($member->contact_public == 1 && $member->photo_url)
                                        <img src="{{ asset('storage/' . $member->photo_url) }}"
                                            alt="{{ $member->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div
                                            class="h-full w-full bg-gray-200 flex items-center justify-center text-gray-500">
                                            <i class="fas fa-user text-4xl"></i>
                                        </div>
                                    @endif

                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $member->name }}</h3>
                                <p class="text-blue-600">{{ $member->department }} - Intake {{ $member->intake }}</p>
                                @if ($member->position)
                                    <p class="text-sm text-gray-500 mt-1">{{ $member->position }}</p>
                                @endif
                                <a href="{{ route('public.members.show', $member) }}"
                                    class="mt-4 inline-block text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500">No members found matching your criteria.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $members->links() }}
                </div>
            </div>
        </section>

        <!-- Become Member CTA -->
        <section class="py-16 bg-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Want to Become a Member?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">Join our community of tech enthusiasts and
                    enhance your skills through various activities.</p>
                <a href="{{ route('public.members.register.form') }}"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Apply Now
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </section>
    </x-slot>
</x-app-layout>
