<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'rounded-lg font-medium transition-all duration-200 hover:scale-105 active:scale-95 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25'
    ]) }}
>
    {{ $slot }}
</button>
