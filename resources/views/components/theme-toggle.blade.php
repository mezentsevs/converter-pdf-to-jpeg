<button
    x-data="themeToggle"
    @click="toggleTheme"
    type="button"
    aria-label="Toggle theme"
    {{ $attributes->merge(['class' => 'inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 focus:outline-none transition duration-150 ease-in-out cursor-pointer']) }}>
    <x-icons.theme-dark-icon x-show="!darkMode" class="w-5 h-5" />
    <x-icons.theme-light-icon x-show="darkMode" class="w-5 h-5" />
</button>
