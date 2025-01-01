<div id="slider" class="py-2 hidden">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-center">
            <figure class="mt-5 flex justify-evenly items-center">
                <x-secondary-button id="prev" class="m-5 h-8" onclick="Slider.prev()">
                    &lt;
                </x-secondary-button>

                <img
                    id="slide"
                    class="mx-6 max-w-60 sm:max-w-96 border-2 border-solid border-indigo-400 dark:border-indigo-600"
                    src=""
                    alt="{{ __('Slide') }}"
                >

                <x-secondary-button id="next" class="m-5 h-8" onclick="Slider.next()">
                    &gt;
                </x-secondary-button>
            </figure>

            @if(session('document'))
                <x-primary-button
                    class="m-5 h-8"
                    onclick="window.location.href = '{{ route('document.download-slider', ['document' => session('document')]) }}';"
                >
                    {{ __('documents.downloads.sliders.button') }}
                </x-primary-button>
            @endif
        </div>
    </div>
</div>
