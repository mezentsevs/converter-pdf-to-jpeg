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
        <div class="py-2">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <figure id="slider" class="p-6 flex justify-between items-center">
                        <x-primary-button id="prev" class="mt-5 sm:m-5 lg:m-5 h-8" onclick="Slider.prev()">
                            &lt;
                        </x-primary-button>

                        <img
                            id="slide"
                            class="mx-6 max-w-60 sm:max-w-96 border-2 border-solid border-indigo-400 dark:border-indigo-600"
                            src=""
                            alt="{{ __('Slide') }}"
                        >

                        <x-primary-button id="next" class="mt-5 sm:m-5 lg:m-5 h-8" onclick="Slider.next()">
                            &gt;
                        </x-primary-button>
                    </figure>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
