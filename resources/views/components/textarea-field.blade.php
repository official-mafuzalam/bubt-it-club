@props(['name', 'label' => '', 'rows' => 4])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif
    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' => 'mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500'
        ]) }}
    >{{ old($name) }}</textarea>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
