<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">Join BUBT IT Club</h1>
                <p class="text-xl mb-8">Become a member of our growing community</p>
            </div>
        </header>

        <!-- Registration Form -->
        <section class="py-16 bg-white">
            <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            General Member Registration
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Fill out the form below to join BUBT IT Club
                        </p>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <form action="{{ route('public.members.register') }}" method="POST"
                            enctype="multipart/form-data" class="divide-y divide-gray-200">
                            @csrf

                            <!-- Personal Information -->
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <div class="sm:col-span-3">
                                    <h4 class="text-md font-medium text-gray-900 mb-4">Personal Information</h4>
                                </div>

                                <!-- Name -->
                                <div class="mb-4 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name
                                        *</label>
                                    <input type="text" name="name" id="name" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-4 sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        *</label>
                                    <input type="email" name="email" id="email" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-4 sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password
                                        *</label>
                                    <input type="password" name="password" id="password" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-4 sm:col-span-3">
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700">Confirm Password *</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <!-- Photo -->
                                <div class="mb-4 sm:col-span-3">
                                    <label for="photo" class="block text-sm font-medium text-gray-700">Profile
                                        Photo</label>
                                    <input type="file" name="photo" id="photo"
                                        class="mt-1 block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100">
                                    @error('photo')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="mb-4 sm:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Gender *</label>
                                    <div class="mt-1 space-y-2">
                                        <div class="flex items-center">
                                            <input id="gender-male" name="gender" type="radio" value="male"
                                                required
                                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                            <label for="gender-male"
                                                class="ml-2 block text-sm text-gray-700">Male</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="gender-female" name="gender" type="radio" value="female"
                                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                            <label for="gender-female"
                                                class="ml-2 block text-sm text-gray-700">Female</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="gender-other" name="gender" type="radio" value="other"
                                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                            <label for="gender-other"
                                                class="ml-2 block text-sm text-gray-700">Other</label>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Academic Information -->
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <div class="sm:col-span-3">
                                    <h4 class="text-md font-medium text-gray-900 mb-4">Academic Information</h4>
                                </div>

                                <!-- Student ID -->
                                <div class="mb-4 sm:col-span-3">
                                    <label for="student_id" class="block text-sm font-medium text-gray-700">Student ID
                                        *</label>
                                    <input type="text" name="student_id" id="student_id" required
                                        placeholder="XX-XXXXX-X"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <p class="mt-1 text-sm text-gray-500">Format: XX-XXXXX-X (e.g., 21-12345-3)</p>
                                    @error('student_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Department -->
                                <div class="mb-4 sm:col-span-3">
                                    <label for="department" class="block text-sm font-medium text-gray-700">Department
                                        *</label>
                                    <select id="department" name="department" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department }}">{{ $department }}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Batch -->
                                <div class="mb-4 sm:col-span-3">
                                    <label for="intake" class="block text-sm font-medium text-gray-700">Intake
                                        *</label>
                                    <input type="number" name="intake" id="intake" required 
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('intake')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="mb-4 sm:col-span-3">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone
                                        Number</label>
                                    <input type="tel" name="phone" id="phone"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <div class="sm:col-span-3">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="terms" name="terms" type="checkbox" required
                                                class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="terms" class="font-medium text-gray-700">I agree to the <a
                                                    href="#" class="text-blue-600 hover:text-blue-500">Terms and
                                                    Conditions</a></label>
                                            <p class="text-gray-500">By registering, you agree to our membership terms.
                                            </p>
                                        </div>
                                    </div>
                                    @error('terms')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
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

                <!-- Already have an account -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already a member?
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                            Sign in here
                        </a>
                    </p>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
