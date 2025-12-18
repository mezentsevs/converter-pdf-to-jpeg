<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('app.name') }}</title>

        <x-theme-init />

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Alternate CSS */
            </style>
        @endif
    </head>
    <body class="font-sans antialiased dark:bg-gray-900 dark:text-white/50">
        <div class="bg-gray-100 text-black/50 dark:bg-gray-900 dark:text-white/50">
            <div class="fixed mx-2 text-sm">
                <small>v{{ config('app.version') }}</small>
            </div>

            <div class="absolute top-4 right-4 z-10">
                <x-theme-toggle />
            </div>

            <div class="relative min-h-screen px-0 sm:px-4 pt-8 sm:pt-0 selection:bg-indigo-500 selection:text-white flex flex-col items-center justify-start sm:justify-center">
                <div class="relative w-full max-w-2xl lg:max-w-7xl min-w-[20rem]">
                    <header class="w-full min-w-min py-4 bg-white dark:bg-gray-800 grid grid-cols-1 sm:grid-cols-3 items-center gap-2 sm:gap-4 rounded-none sm:rounded-2xl shadow-md">
                        <h1 class="flex flex-row items-center justify-center sm:col-start-2 sm:justify-center">
                            <a href="/" class="inline-block w-8 h-8 sm:w-12 sm:h-12 shrink-0 m-1 sm:m-2 text-indigo-500 dark:text-indigo-600">
                                <x-application-logo />
                            </a>
                            <span class="inline-block text-gray-700 dark:text-white text-lg sm:text-xl lg:text-3xl font-black tracking-tight whitespace-nowrap">
                                {{ __('app.name') }}
                            </span>
                        </h1>

                        @if (Route::has('login'))
                            <nav class="px-2 flex justify-center sm:justify-end sm:col-start-3">
                                <div class="flex flex-wrap justify-center gap-1 sm:gap-0">
                                    @auth
                                        <x-nav-button href="{{ url('/dashboard') }}">
                                            Dashboard
                                        </x-nav-button>
                                    @else
                                        <x-nav-button href="{{ route('login') }}">
                                            Log in
                                        </x-nav-button>

                                        @if (Route::has('register'))
                                            <x-nav-button href="{{ route('register') }}">
                                                Register
                                            </x-nav-button>
                                        @endif
                                    @endauth
                                </div>
                            </nav>
                        @endif
                    </header>

                    <main class="min-w-min min-h-96 mt-1 sm:mt-10 px-0 sm:px-8 py-6 sm:py-10 bg-white dark:bg-gray-800 text-black dark:text-white/70 text-center flex flex-col justify-center rounded-none sm:rounded-2xl shadow-md">
                        <p class="max-w-2xl mx-auto text-base sm:text-lg leading-relaxed">
                            This is a converter
                            <span class="text-indigo-500 dark:text-indigo-600 font-medium">pdf</span>
                            to
                            <span class="text-indigo-500 dark:text-indigo-600 font-medium">jpeg</span>,
                            written in and for educational and demonstrational purposes.
                        </p>
                    </main>

                    <footer class="py-8 sm:py-16 text-xs sm:text-sm text-center">
                        <small>&copy; {{ date('Y') }} {{ __('app.name') }} All rights reserved | Laravel v{{ Illuminate\Foundation\Application::VERSION }} | PHP v{{ PHP_VERSION }}</small>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
