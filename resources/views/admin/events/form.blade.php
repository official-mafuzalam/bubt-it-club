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
            <input type="datetime-local" name="start_date" id="start_date" required onclick="this.showPicker()"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                value="{{ old('start_date', $event?->start_date ? $event->start_date->format('Y-m-d\TH:i') : '') }}">
            @error('start_date')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- End Date -->
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date *</label>
            <input type="datetime-local" name="end_date" id="end_date" required onclick="this.showPicker()"
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

    <!-- Payment Information -->
    @php
        // old input first
        $paymentMethods = old('payment_methods');

        if (!$paymentMethods && !empty($event->payment_methods)) {
            // decode if string
            $rawMethods = is_string($event->payment_methods)
                ? json_decode($event->payment_methods, true)
                : $event->payment_methods;

            // convert numeric indexed array to associative by type
            $paymentMethods = [];
            foreach ($rawMethods as $method) {
                if (isset($method['type'])) {
                    $paymentMethods[$method['type']] = [
                        'number' => $method['number'] ?? '',
                    ];
                }
            }
        }

        // fallback
        $paymentMethods = $paymentMethods ?? [];
    @endphp


    <div>
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Payment Information</h3>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Is Paid Checkbox -->
            <div class="flex items-center space-x-2">
                <input type="hidden" name="is_paid" value="0">
                <input type="checkbox" name="is_paid" id="is_paid" value="1"
                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                    {{ old('is_paid', $event->is_paid ?? 0) ? 'checked' : '' }}>
                <label for="is_paid" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Is Paid
                    Event?</label>
            </div>

            <!-- Ticket Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ticket Price</label>
                <input type="number" name="ticket_price" id="ticket_price" step="0.01"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    value="{{ old('ticket_price', $event->ticket_price ?? '') }}">
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Methods</label>

            @foreach (['bkash', 'nagad', 'rocket'] as $item)
                <div class="grid grid-cols-2 gap-2 mb-2">
                    <input type="hidden" name="payment_methods[{{ $item }}][type]"
                        value="{{ $item }}">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ ucfirst($item) }}
                        Number</label>
                    <input type="text" name="payment_methods[{{ $item }}][number]"
                        id="payment_methods_{{ $item }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        value="{{ $paymentMethods[$item]['number'] ?? '' }}">
                </div>
            @endforeach

        </div>
    </div>



</div>
