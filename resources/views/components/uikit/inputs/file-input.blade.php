@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-100 dark:bg-gray-900 dark:text-gray-300 rounded-sm shadow-sm']) }}>
