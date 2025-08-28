@props(['name', 'options' => [], 'label' => ''])

<div class="mb-4">
    @if($label)
        <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</span>
    @endif
    <div class="mt-2 flex items-center gap-4">
        @foreach($options as $value => $text)
            <label class="flex items-center">
                <input type="radio" name="{{ $name }}" value="{{ $value }}"
                    class="text-blue-600 border-gray-300 dark:border-gray-600"
                    {{ old($name) == $value ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $text }}</span>
            </label>
        @endforeach
    </div>
</div>
