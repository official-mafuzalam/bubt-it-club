<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">Register for: {{ $event->title }}</h1>
                <p class="text-xl mb-8">{{ $event->start_date->format('l, F j, Y') }} • {{ $event->location }}</p>
            </div>
        </header>

        <!-- Registration Form -->
        <section class="py-16 bg-white">
            <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Event Registration
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Please fill out the form below to register for this event.
                        </p>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <form action="{{ route('public.events.register', $event->id) }}" method="POST"
                            class="divide-y divide-gray-200">
                            @csrf

                            <!-- Personal Information -->
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <div class="sm:col-span-3">
                                    <h4 class="text-md font-medium text-gray-900 mb-4">Personal Information</h4>
                                </div>

                                <!-- Name -->
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name
                                        *</label>
                                    <input type="text" name="name" id="name" required
                                        value="{{ old('name', auth()->user() ? auth()->user()->name : '') }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <!-- Email -->
                                <div class="mt-4 sm:mt-0 sm:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        *</label>
                                    <input type="email" name="email" id="email" required
                                        value="{{ old('email', auth()->user() ? auth()->user()->email : '') }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <!-- Phone -->
                                <div class="mt-4 sm:mt-0 sm:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone
                                        Number</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <!-- Academic Information (for students) -->
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <div class="sm:col-span-3">
                                    <h4 class="text-md font-medium text-gray-900 mb-4">Academic Information</h4>
                                </div>

                                <!-- Student ID -->
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <label for="student_id" class="block text-sm font-medium text-gray-700">Student
                                        ID</label>
                                    <input type="text" name="student_id" id="student_id"
                                        value="{{ old('student_id') }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <!-- Department -->
                                <div class="mt-4 sm:mt-0 sm:col-span-2">
                                    <label for="department"
                                        class="block text-sm font-medium text-gray-700">Department</label>
                                    <select id="department" name="department"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="">Select Department</option>
                                        <option value="CSE" {{ old('department') == 'CSE' ? 'selected' : '' }}>
                                            Computer Science & Engineering</option>
                                        <option value="EEE" {{ old('department') == 'EEE' ? 'selected' : '' }}>
                                            Electrical & Electronic Engineering</option>
                                        <option value="BBA" {{ old('department') == 'BBA' ? 'selected' : '' }}>
                                            Business Administration</option>
                                        <option value="MBA" {{ old('department') == 'MBA' ? 'selected' : '' }}>
                                            Masters of Business Administration</option>
                                        <option value="other" {{ old('department') == 'other' ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <div class="sm:col-span-3">
                                    <h4 class="text-md font-medium text-gray-900 mb-4">Additional Information</h4>
                                </div>

                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <label for="additional_info" class="block text-sm font-medium text-gray-700">
                                        Any special requirements or questions?
                                    </label>
                                    <textarea id="additional_info" name="additional_info" rows="3"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('additional_info') }}</textarea>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Complete Registration
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Event Summary -->
                <div class="mt-8 bg-gray-50 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Event Details</h3>
                    <div class="flex items-start">
                        @if ($event->image_url)
                            <div class="flex-shrink-0 mr-4">
                                <img class="h-16 w-16 rounded-md object-cover"
                                    src="{{ asset('storage/' . $event->image_url) }}" alt="{{ $event->title }}">
                            </div>
                        @endif
                        <div>
                            <h4 class="text-md font-medium">{{ $event->title }}</h4>
                            <p class="text-sm text-gray-500 mt-1">
                                <i class="far fa-calendar-alt mr-2"></i>
                                {{ $event->start_date->format('l, F j, Y') }}
                                <span class="mx-2">•</span>
                                {{ $event->start_date->format('h:i A') }} - {{ $event->end_date->format('h:i A') }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $event->location }}
                            </p>
                            @if ($event->max_participants)
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="fas fa-users mr-2"></i>
                                    {{ $event->remaining_seats }} of {{ $event->max_participants }} seats remaining
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>