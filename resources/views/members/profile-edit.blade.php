<x-member-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Profile Edit</title>
        @endsection

        <div class="max-w-4xl mx-auto space-y-6">

            <form action="{{ route('members.profile.update') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded shadow">
                @csrf
                @method('PUT')

                <!-- Profile Header -->
                <div class="flex items-center space-x-6">
                    <div>
                        <img id="previewPhoto"
                            src="{{ $member->photo_url ? asset('storage/' . $member->photo_url) : 'https://ui-avatars.com/api/?name=' . $member->name }}"
                            alt="Avatar"
                            class="w-24 h-24 rounded-full border border-gray-300 dark:border-gray-600 object-cover">
                        <label class="block mt-2 text-sm text-gray-700 dark:text-gray-300">Change Photo</label>
                        <input type="file" name="photo" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400"
                            onchange="document.getElementById('previewPhoto').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="flex-1 space-y-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" name="name" value="{{ old('name', $member->name) }}"
                                class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" value="{{ old('email', $member->email) }}"
                                class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input type="password" name="password" placeholder="Leave blank to keep current"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm new password"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                </div>

                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Student ID</label>
                        <input type="text" name="student_id" value="{{ old('student_id', $member->student_id) }}"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department</label>
                        <input type="text" name="department" value="{{ old('department', $member->department) }}"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Intake</label>
                        <input type="number" name="intake" value="{{ old('intake', $member->intake) }}"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $member->phone) }}"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                        <select name="gender"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="male" {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="female" {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>
                                Female</option>
                            <option value="other" {{ old('gender', $member->gender) == 'other' ? 'selected' : '' }}>
                                Other</option>
                        </select>
                    </div>
                </div>

                <!-- Bio -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
                    <textarea name="bio" rows="4"
                        class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">{{ old('bio', $member->bio) }}</textarea>
                </div>

                <!-- Social Links -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Social Links</label>
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

                <!-- Favorite Categories -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Favorite
                        Categories</label>
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
                </div>

                <!-- Visibility -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Info
                            Visibility (Email , Mobile Number, Profile Picture)</label>
                        <select name="contact_public"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="1" {{ $member->contact_public ? 'selected' : '' }}>Public</option>
                            <option value="0" {{ !$member->contact_public ? 'selected' : '' }}>Private</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Social Links
                            Visibility</label>
                        <select name="social_links_public"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="1" {{ $member->social_links_public ? 'selected' : '' }}>Public
                            </option>
                            <option value="0" {{ !$member->social_links_public ? 'selected' : '' }}>Private
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex justify-between">
                    <div>
                        <a href="{{ route('members.profile') }}"
                            class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                            Cancel
                        </a>
                    </div>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update Profile
                    </button>
                </div>

            </form>

        </div>

    </x-slot>
</x-member-layout>
