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
