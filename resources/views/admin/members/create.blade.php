<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Add New Member | BUBT IT Club</title>
        @endsection

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Add New Member</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Register a new member to BUBT IT Club</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.members.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                    Back to Members
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="p-6 space-y-8">

                    <!-- SECTION 1: Personal Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2">
                            Personal Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <x-input-field label="Full Name *" name="name" type="text" :value="old('name')" required />

                            <!-- Email -->
                            <x-input-field label="Email *" name="email" type="email" :value="old('email')" required />

                            <!-- Password -->
                            <x-input-field label="Password *" name="password" type="password" required />

                            <!-- Confirm Password -->
                            <x-input-field label="Confirm Password *" name="password_confirmation" type="password" required />

                            <!-- Gender -->
                            <x-select-field label="Gender *" name="gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :selected="old('gender')" required />

                            <!-- Profile Photo -->
                            <x-file-upload label="Profile Photo" name="photo" accept="image/*" />
                        </div>
                    </div>

                    <!-- SECTION 2: Academic Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2">
                            Academic Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input-field label="Student ID *" name="student_id" type="text" :value="old('student_id')" placeholder="e.g. 22151010XX" required />
                            <x-select-field label="Department *" name="department" :options="$departments" :selected="old('department')" required />
                            <x-input-field label="Intake *" name="intake" type="number" min="1" max="99" :value="old('intake')" required />
                            <x-input-field label="Phone Number" name="phone" type="text" :value="old('phone')" />
                            <x-select-field label="Position in Club" name="position" :options="$positions" :selected="old('position')" />
                            <x-input-field label="Birthdate" name="birthdate" type="date" :value="old('birthdate')" />
                        </div>
                    </div>

                    <!-- SECTION 3: Additional Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2">
                            Additional Information
                        </h3>
                        <div class="space-y-6">
                            <!-- Bio -->
                            <x-textarea-field label="Bio" name="bio">{{ old('bio') }}</x-textarea-field>

                            <!-- Social Links -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Social Links</label>
                                <div class="space-y-2">
                                    @foreach (['facebook', 'twitter', 'linkedin', 'github'] as $social)
                                        <div class="flex items-center">
                                            <span class="w-24 text-sm text-gray-500 dark:text-gray-400 capitalize">{{ $social }}</span>
                                            <input type="url" name="social_links[{{ $social }}]"
                                                   placeholder="https://"
                                                   value="{{ old('social_links.' . $social) }}"
                                                   class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Favorite Categories -->
                            <div>
                                <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Favorite Categories</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                    @foreach ($categories as $category)
                                        <label class="flex items-center">
                                            <input type="checkbox" name="favorite_categories[]" value="{{ $category }}"
                                                   {{ in_array($category, old('favorite_categories', [])) ? 'checked' : '' }}
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                            <span class="ml-2 text-sm text-gray-900 dark:text-gray-300">{{ $category }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Joined Date & Status -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-input-field label="Joined Date *" name="joined_at" type="date" :value="old('joined_at', now()->format('Y-m-d'))" required />
                                <x-radio-field label="Status" name="is_active" :options="['1' => 'Active', '0' => 'Inactive']" :checked="old('is_active', 1)" />
                            </div>

                            <!-- Visibility Options -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-radio-field label="Contact Info Visibility" name="contact_public" :options="['1' => 'Public', '0' => 'Private']" :checked="old('contact_public', 0)" />
                                <x-radio-field label="Social Links Visibility" name="social_links_public" :options="['1' => 'Public', '0' => 'Private']" :checked="old('social_links_public', 0)" />
                            </div>

                            <!-- Payment Info -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <x-select-field label="Payment Method *" name="payment_method"
                                                :options="['bkash'=>'bKash','rocket'=>'Rocket','nagad'=>'Nagad','hand_cash'=>'Hand Cash']"
                                                :selected="old('payment_method')" required />
                                <x-input-field label="Amount *" name="amount" type="number" :value="old('amount')" required />
                                <x-input-field label="Transaction ID *" name="transaction_id" type="text" :value="old('transaction_id')" required />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-end p-6 bg-gray-50 dark:bg-gray-700 space-x-3">
                    <button type="reset" class="btn-secondary">Reset</button>
                    <button type="submit" class="btn-primary">Save Member</button>
                </div>
            </form>
        </div>
    </x-slot>
</x-admin-layout>
