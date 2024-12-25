<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('app.name') }}
        </h2>
    </x-slot>

    @if(session('uploaded'))
        <div class="py-2">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 text-green-600 dark:text-green-300">
                        {{ session('uploaded') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="py-2">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 text-red-600 dark:text-red-300">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('converted'))
        <div class="py-2">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 text-green-600 dark:text-green-300">
                        {{ session('converted') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('slides'))
        @foreach(session('slides') as $slide)
            <div class="py-2">
                <div class="max-w-3xl mx-auto">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <img src="{{ $slide }}" alt="{{ $slide }}">
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</x-app-layout>
