@props(['name' => 'file', 'label' => 'Upload File'])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }}
    </label>
    <input type="file" name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white']) }} />
</div>
