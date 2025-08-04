@props(['event' => null])

<div class="space-y-6">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Title *</label>
            <input type="text" name="title" id="title" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                value="{{ old('title', $event?->title) }}">
            @error('title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category -->
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category *</label>
            <select id="category" name="category" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Select a category</option>
                <option value="workshop" {{ old('category', $event?->category) === 'workshop' ? 'selected' : '' }}>
                    Workshop</option>
                <option value="seminar" {{ old('category', $event?->category) === 'seminar' ? 'selected' : '' }}>Seminar
                </option>
                <option value="hackathon" {{ old('category', $event?->category) === 'hackathon' ? 'selected' : '' }}>
                    Hackathon</option>
                <option value="competition"
                    {{ old('category', $event?->category) === 'competition' ? 'selected' : '' }}>Competition</option>
                <option value="other" {{ old('category', $event?->category) === 'other' ? 'selected' : '' }}>Other
                </option>
            </select>
            @error('category')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description
            *</label>
        <textarea id="description" name="description" rows="4" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $event?->description) }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Start Date -->
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date
                *</label>
            <input type="datetime-local" name="start_date" id="start_date" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                value="{{ old('start_date', $event?->start_date ? $event->start_date->format('Y-m-d\TH:i') : '') }}">
            @error('start_date')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- End Date -->
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date *</label>
            <input type="datetime-local" name="end_date" id="end_date" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                value="{{ old('end_date', $event?->end_date ? $event->end_date->format('Y-m-d\TH:i') : '') }}">
            @error('end_date')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Location -->
        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location *</label>
            <input type="text" name="location" id="location" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                value="{{ old('location', $event?->location) }}">
            @error('location')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Max Participants -->
        <div>
            <label for="max_participants" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Max
                Participants (leave empty for unlimited)</label>
            <input type="number" name="max_participants" id="max_participants" min="1"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                value="{{ old('max_participants', $event?->max_participants) }}">
            @error('max_participants')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Image Upload -->
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Image</label>
        @if ($event?->image_url)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $event->image_url) }}" alt="Current event image"
                    class="h-32 w-32 object-cover rounded-md">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Current image</p>
            </div>
        @endif
        <input type="file" name="image" id="image"
            class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                   file:mr-4 file:py-2 file:px-4
                   file:rounded-md file:border-0
                   file:text-sm file:font-semibold
                   file:bg-blue-50 file:text-blue-700
                   hover:file:bg-blue-100">
        @error('image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Published Status -->
    <div class="flex items-center">
        <input id="is_published" name="is_published" type="checkbox"
            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
            {{ old('is_published', $event?->is_published) ? 'checked' : '' }}>
        <label for="is_published" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
            Publish this event
        </label>
    </div>
</div>
