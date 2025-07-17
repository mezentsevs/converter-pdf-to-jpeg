<section id="slider" class="max-w-3xl mx-auto my-2 bg-white dark:bg-gray-800 text-center overflow-hidden sm:rounded-lg shadow-sm hidden">
    <figure class="mt-5 flex justify-evenly items-center">
        <x-secondary-button id="prev" class="h-8 m-5" onclick="Slider.prev()">
            &lt;
        </x-secondary-button>

        <img
            id="slide"
            class="max-w-60 sm:max-w-96 mx-6 border-2 border-solid border-gray-400 dark:border-gray-600"
            src=""
            alt="{{ __('Slide') }}"
        >

        <x-secondary-button id="next" class="h-8 m-5" onclick="Slider.next()">
            &gt;
        </x-secondary-button>
    </figure>

    @if(session('document'))
        <x-primary-button
            class="h-8 m-5"
            onclick="window.location.href = '{{ route('document.download-slider', ['document' => session('document')]) }}';"
        >
            {{ __('documents.downloads.sliders.button') }}
        </x-primary-button>
    @endif
</section>
