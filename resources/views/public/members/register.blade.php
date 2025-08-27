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
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-5 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">General Member Registration</h3>
                        <p class="mt-1 text-sm text-gray-500">Fill out the form below to join BUBT IT Club</p>
                    </div>
                    <div class="border-t border-gray-200 px-6 py-5">
                        <form action="{{ route('public.members.register') }}" method="POST"
                            enctype="multipart/form-data" class="space-y-8">
                            @csrf

                            <!-- Personal Information -->
                            <div>
                                <h4 class="text-md font-medium text-gray-900 mb-4">Personal Information</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <!-- Name -->
                                    <div class="col-span-1 sm:col-span-2">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name
                                            *</label>
                                        <input type="text" name="name" id="name" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        @error('name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email
                                            *</label>
                                        <input type="email" name="email" id="email" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone
                                            Number</label>
                                        <input type="tel" name="phone" id="phone"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        @error('phone')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700">Password
                                            *</label>
                                        <input type="password" name="password" id="password" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        @error('password')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <label for="password_confirmation"
                                            class="block text-sm font-medium text-gray-700">Confirm Password *</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>

                                    <!-- Profile Photo -->
                                    <div class="col-span-1 sm:col-span-2">
                                        <label for="photo" class="block text-sm font-medium text-gray-700">Profile
                                            Photo</label>
                                        <input type="file" name="photo" id="photo"
                                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        @error('photo')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Gender -->
                                    <div class="col-span-1 sm:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Gender *</label>
                                        <div class="mt-2 flex items-center gap-6">
                                            <label class="flex items-center">
                                                <input type="radio" name="gender" value="male" required
                                                    class="h-4 w-4 text-blue-600 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-700">Male</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" name="gender" value="female"
                                                    class="h-4 w-4 text-blue-600 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-700">Female</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" name="gender" value="other"
                                                    class="h-4 w-4 text-blue-600 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-700">Other</span>
                                            </label>
                                        </div>
                                        @error('gender')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Academic Information -->
                            <div>
                                <h4 class="text-md font-medium text-gray-900 mb-4">Academic Information</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <!-- Student ID -->
                                    <div>
                                        <label for="student_id" class="block text-sm font-medium text-gray-700">Student
                                            ID *</label>
                                        <input type="text" name="student_id" id="student_id" required
                                            placeholder="XX-XXXXX-X"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <p class="mt-1 text-sm text-gray-500">Format: XX-XXXXX-X</p>
                                        @error('student_id')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Intake -->
                                    <div>
                                        <label for="intake" class="block text-sm font-medium text-gray-700">Intake
                                            *</label>
                                        <input type="number" name="intake" id="intake" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        @error('intake')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Department -->
                                    <div class="col-span-1 sm:col-span-2">
                                        <label for="department"
                                            class="block text-sm font-medium text-gray-700">Department *</label>
                                        <select id="department" name="department" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="">Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department }}">{{ $department }}</option>
                                            @endforeach
                                        </select>
                                        @error('department')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-md font-medium text-gray-900 mb-4">Payment Information</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div>
                                        <label for="payment_method"
                                            class="block text-sm font-medium text-gray-700">Payment Method *</label>
                                        <select id="payment_method" name="payment_method" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="">Select Payment Method</option>
                                            <option value="bkash">bKash</option>
                                            <option value="rocket">Rocket</option>
                                            <option value="nagad">Nagad</option>
                                            <option value="hand_cash">Hand Cash</option>
                                        </select>
                                        @error('payment_method')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="amount" class="block text-sm font-medium text-gray-700">Amount
                                            *</label>
                                        <input type="number" id="amount" name="amount" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        @error('amount')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-2">
                                        <label for="transaction_id"
                                            class="block text-sm font-medium text-gray-700">Transaction ID *</label>
                                        <input type="text" id="transaction_id" name="transaction_id" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        @error('transaction_id')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Terms -->
                            <div class="flex items-start">
                                <input id="terms" name="terms" type="checkbox" required
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <label for="terms" class="ml-2 text-sm text-gray-700">
                                    I agree to the <a href="#" class="text-blue-600 hover:text-blue-500">Terms
                                        and Conditions</a>
                                </label>
                            </div>

                            <!-- Submit -->
                            <div class="text-right">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Complete Registration
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already a member?
                        <a href="{{ route('members.login') }}"
                            class="font-medium text-blue-600 hover:text-blue-500">Sign in
                            here</a>
                    </p>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
