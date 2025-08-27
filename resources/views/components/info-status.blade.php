<div>
    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $label }}</p>
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
        {{ $status ? 'bg-'.$trueColor.'-100 text-'.$trueColor.'-800' : 'bg-'.$falseColor.'-100 text-'.$falseColor.'-800' }}">
        {{ $status ? $trueText : $falseText }}
    </span>
</div>
