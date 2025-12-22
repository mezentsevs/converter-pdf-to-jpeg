<section id="slider" class="min-w-[320px] max-w-3xl mx-auto my-2 bg-white dark:bg-gray-800 text-center overflow-hidden sm:rounded-lg shadow-sm hidden">
    <div class="p-4">
        <figure class="mb-6">
            <img
                id="slide"
                class="w-full rounded-lg border-2 border-gray-200 dark:border-gray-700 shadow-sm"
                src=""
                alt="{{ __('Slide') }}"
            />
        </figure>

        <div class="mb-6">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <div class="flex w-full sm:w-auto gap-4">
                    <x-uikit.buttons.control-button 
                        id="prev" 
                        onclick="Slider.prev()"
                        class="h-12 flex-1 sm:flex-none sm:w-32 md:w-40 justify-center"
                    >
                        <span class="text-lg">&lsaquo;</span>
                        <span class="hidden sm:inline ml-2">Previous</span>
                    </x-uikit.buttons.control-button>

                    <x-uikit.buttons.control-button 
                        id="next" 
                        onclick="Slider.next()"
                        class="h-12 flex-1 sm:flex-none sm:w-32 md:w-40 justify-center"
                    >
                        <span class="hidden sm:inline mr-2">Next</span>
                        <span class="text-lg">&rsaquo;</span>
                    </x-uikit.buttons.control-button>
                </div>
            </div>
        </div>

        <div id="download-container" class="flex justify-center">
            <x-uikit.buttons.primary-button
                id="download-button"
                class="h-12 w-full sm:w-auto px-8 rounded-lg font-medium transition-all duration-200 hover:scale-105 active:scale-95 justify-center"
            >
                <x-icons.download-icon class="w-5 h-5 inline mr-2" />
                {{ __('documents.downloads.sliders.button') }}
            </x-uikit.buttons.primary-button>
        </div>
    </div>
</section>
