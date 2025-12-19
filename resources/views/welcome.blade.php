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
    @endif
</head>
<body class="font-sans antialiased dark:bg-gray-900 dark:text-white/50">
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
        <nav class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="/" class="inline-block w-8 h-8 sm:w-10 sm:h-10 text-indigo-500 dark:text-indigo-600 transition-transform hover:scale-105">
                        <x-icons.application-logo-icon />
                    </a>
                    <span class="text-lg sm:text-xl font-bold text-gray-800 dark:text-white">
                        {{ __('app.name') }}
                    </span>
                </div>

                <div class="flex items-center space-x-3 sm:space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="px-3 sm:px-4 py-2 text-sm font-medium text-indigo-600 dark:text-indigo-400 border border-indigo-600 dark:border-indigo-400 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-all duration-200 whitespace-nowrap">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="px-3 sm:px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200 whitespace-nowrap">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="px-3 sm:px-4 py-2 text-sm font-medium text-white bg-indigo-600 dark:bg-indigo-500 rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-600 transition-all duration-200 shadow-sm hover:shadow whitespace-nowrap">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                    
                    <x-theme-toggle class="text-gray-600 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 ml-2" />
                </div>
            </div>
        </nav>

        <main class="container mx-auto px-4 py-8 sm:py-12 lg:py-16">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12 sm:mb-16 animate-fade-in-up">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4 leading-tight">
                        Professional PDF to JPEG
                        <span class="text-indigo-600 dark:text-indigo-400">Converter</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto mb-8">
                        A secure, high-quality solution for converting PDF documents to JPEG images with built-in preview and archival capabilities
                    </p>
                    
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-indigo-600 dark:bg-indigo-500 rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Go to Dashboard
                            <x-icons.arrow-right-icon class="w-5 h-5 ml-2" />
                        </a>
                    @else
                        <a href="{{ route('register') }}" 
                           class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-indigo-600 dark:bg-indigo-500 rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Start Converting
                            <x-icons.arrow-right-icon class="w-5 h-5 ml-2" />
                        </a>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 mb-16 sm:mb-20">
                    @php
                        $features = [
                            [
                                'icon' => 'upload',
                                'title' => 'Secure Upload',
                                'description' => 'Protected PDF upload with validation and user-specific storage',
                            ],
                            [
                                'icon' => 'convert',
                                'title' => 'High-Quality Conversion',
                                'description' => 'Convert PDF pages to JPEG with 300 DPI resolution and optimal compression',
                            ],
                            [
                                'icon' => 'preview',
                                'title' => 'Interactive Preview',
                                'description' => 'Built-in image slider for instant preview of converted pages',
                            ],
                            [
                                'icon' => 'download',
                                'title' => 'Complete Archive',
                                'description' => 'Download all images as a ZIP archive with portable HTML slider',
                            ]
                        ];
                    @endphp

                    @foreach ($features as $index => $feature)
                        <div class="group animate-fade-in-up" style="animation-delay: {{ ($index + 1) * 100 }}ms">
                            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 h-full border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 mb-4 group-hover:scale-110 transition-transform duration-200">
                                    @if ($feature['icon'] === 'upload')
                                        <x-icons.upload-icon class="w-6 h-6" />
                                    @elseif ($feature['icon'] === 'convert')
                                        <x-icons.convert-icon class="w-6 h-6" />
                                    @elseif ($feature['icon'] === 'preview')
                                        <x-icons.preview-icon class="w-6 h-6" />
                                    @elseif ($feature['icon'] === 'download')
                                        <x-icons.download-icon class="w-6 h-6" />
                                    @endif
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $feature['title'] }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">{{ $feature['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="bg-gradient-to-r from-gray-50 to-indigo-50 dark:from-gray-800 dark:to-indigo-900/20 rounded-2xl p-6 sm:p-8 lg:p-12 mb-16 animate-fade-in-up" style="animation-delay: 500ms">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">How It Works</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                        @php
                            $steps = [
                                ['num' => '01', 'title' => 'Upload PDF', 'desc' => 'Upload your PDF document through the secure dashboard'],
                                ['num' => '02', 'title' => 'Automatic Processing', 'desc' => 'System converts each page to high-quality JPEG images'],
                                ['num' => '03', 'title' => 'Preview & Download', 'desc' => 'View results in the slider and download complete archive']
                            ];
                        @endphp

                        @foreach ($steps as $index => $step)
                            <div class="text-center group animate-fade-in-up" style="animation-delay: {{ 600 + ($index * 100) }}ms">
                                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-white dark:bg-gray-800 text-indigo-600 dark:text-indigo-400 text-xl font-bold mb-4 shadow-sm group-hover:shadow-md transition-shadow duration-200">
                                    {{ $step['num'] }}
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $step['title'] }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $step['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-center animate-fade-in-up" style="animation-delay: 900ms">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-4">Ready to Convert Your Documents?</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                        Join users who trust our professional conversion tool for their document processing needs
                    </p>
                    
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="inline-flex items-center px-8 py-4 text-lg font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 rounded-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                            <x-icons.check-circle-icon class="w-5 h-5 mr-2" />
                            Go to Dashboard
                        </a>
                    @else
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('register') }}" 
                               class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 rounded-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                                Get Started Free
                            </a>
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-indigo-600 dark:text-indigo-400 border-2 border-indigo-600 dark:border-indigo-400 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-all duration-300">
                                Sign In to Account
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </main>

        <footer class="mt-20 border-t border-gray-200 dark:border-gray-800 pt-8 pb-6">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <div class="flex items-center space-x-3 mb-2">
                            <a href="/" class="inline-block w-6 h-6 text-indigo-500 dark:text-indigo-600">
                                <x-icons.application-logo-icon />
                            </a>
                            <span class="text-sm font-medium text-gray-800 dark:text-white">
                                {{ __('app.name') }} v{{ config('app.version') }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 italic">
                            This is a converter pdf to jpeg, written in and for educational and demonstrational purposes.
                        </p>
                    </div>
                    
                    <div class="text-center md:text-right">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                            <span class="hidden sm:inline">Powered by </span>
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} | PHP v{{ PHP_VERSION }}
                        </div>
                        <small class="text-xs text-gray-400 dark:text-gray-500">
                            &copy; {{ date('Y') }} {{ __('app.name') }}. All rights reserved.
                        </small>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }
    </style>
</body>
</html>
