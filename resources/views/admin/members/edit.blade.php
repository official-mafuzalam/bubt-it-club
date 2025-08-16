<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Edit Member | BUBT IT Club</title>
        @endsection

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Edit Member
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Update member information for BUBT IT Club
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.members.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                    Back to Members
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <form action="{{ route('admin.members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Personal Information</h3>

                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('name', $member->name) }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('email', $member->email) }}">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Password
                                </label>
                                <input type="password" name="password" id="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Leave blank to keep current password">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Confirm Password
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Leave blank to keep current password">
                            </div>

                            <div>
                                <label for="gender"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Gender <span class="text-red-500">*</span>
                                </label>
                                <select name="gender" id="gender" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select Gender</option>
                                    <option value="male"
                                        {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female"
                                        {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="other"
                                        {{ old('gender', $member->gender) == 'other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="photo"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Profile Photo
                                </label>
                                @if ($member->photo_url)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $member->photo_url) }}" alt="Profile Photo"
                                            class="h-20 w-20 rounded-full object-cover">
                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="remove_photo" value="1"
                                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-offset-0 focus:ring-blue-200 focus:ring-opacity-50">
                                                <span class="ml-2">Remove current photo</span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <input type="file" name="photo" id="photo"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    accept="image/*">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Upload a new photo to replace the existing one
                                </p>
                                @error('photo')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Academic Information</h3>

                            <div>
                                <label for="student_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Student ID <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="student_id" id="student_id" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="e.g. 22151010XX" value="{{ old('student_id', $member->student_id) }}">
                                @error('student_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="department"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Department <span class="text-red-500">*</span>
                                </label>
                                <select name="department" id="department" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept }}"
                                            {{ old('department', $member->department) == $dept ? 'selected' : '' }}>
                                            {{ $dept }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="intake"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Intake <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="intake" id="intake" min="1" max="99"
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('intake', $member->intake) }}">
                                @error('intake')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Phone Number
                                </label>
                                <input type="text" name="phone" id="phone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('phone', $member->phone) }}">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="position"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Position in Club
                                </label>
                                <select name="position" id="position"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select Position</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position }}"
                                            {{ old('position', $member->position) == $position ? 'selected' : '' }}>
                                            {{ $position }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('position')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Additional Information</h3>

                        <div>
                            <label for="bio"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Bio
                            </label>
                            <textarea name="bio" id="bio" rows="3"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('bio', $member->bio) }}</textarea>
                            @error('bio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Social Links
                            </label>
                            <div class="space-y-2">
                                @php
                                    // Decode JSON if it's a string, or use as array
$socialLinks = [];
if (is_string($member->social_links)) {
    $socialLinks = json_decode($member->social_links, true) ?? [];
} elseif (is_array($member->social_links)) {
    $socialLinks = $member->social_links;
}
$socialLinks = old('social_links', $socialLinks);
                                @endphp

                                @foreach (['facebook', 'twitter', 'linkedin', 'github'] as $social)
                                    <div class="flex items-center">
                                        <span
                                            class="w-24 text-sm text-gray-500 dark:text-gray-400 capitalize">{{ $social }}</span>
                                        <input type="url" name="social_links[{{ $social }}]"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="https://" value="{{ $socialLinks[$social] ?? '' }}">
                                    </div>
                                @endforeach
                            </div>
                            @error('social_links.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Favorite Categories
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                @php
                                    // Decode JSON if it's a string, or use as array
$favoriteCategories = [];
if (is_string($member->favorite_categories)) {
    $favoriteCategories = json_decode($member->favorite_categories, true) ?? [];
} elseif (is_array($member->favorite_categories)) {
    $favoriteCategories = $member->favorite_categories;
}
$favoriteCategories = old('favorite_categories', $favoriteCategories);
                                @endphp

                                @foreach ($categories as $category)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="favorite_categories[]"
                                            id="category_{{ strtolower($category) }}" value="{{ $category }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            {{ in_array($category, $favoriteCategories) ? 'checked' : '' }}>
                                        <label for="category_{{ strtolower($category) }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            {{ $category }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('favorite_categories')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="joined_at"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Joined Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="joined_at" id="joined_at" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('joined_at', $member->joined_at->format('Y-m-d')) }}">
                                @error('joined_at')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Status
                                </label>
                                <div class="flex items-center">
                                    <div class="flex items-center mr-4">
                                        <input type="radio" name="is_active" id="active" value="1"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            {{ old('is_active', $member->is_active) == 1 ? 'checked' : '' }}>
                                        <label for="active"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Active
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="is_active" id="inactive" value="0"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            {{ old('is_active', $member->is_active) == 0 ? 'checked' : '' }}>
                                        <label for="inactive"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                                @error('is_active')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="flex items-center justify-end p-6 bg-gray-50 dark:bg-gray-700 space-x-3">
                    <button type="reset"
                        class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">
                        Reset
                    </button>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update Member
                    </button>
                </div>
            </form>
        </div>
    </x-slot>
</x-admin-layout>
