<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 dark:text-gray-200 text-xl font-semibold leading-tight">
            {{ __('app.name') }}
        </h2>
    </x-slot>

    <div class="w-full max-w-3xl min-w-[280px] mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-20">
        <div class="p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden sm:rounded-lg shadow-sm">
            <form
                id="documentUploadForm"
                method="POST"
                action="{{ route('document.store') }}"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="flex flex-col">
                    <x-uikit.inputs.input-label for="document" :value="__('documents.uploads.label')" />

                    <div class="mt-4 flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="flex-1">
                            <x-uikit.inputs.file-input
                                id="document"
                                type="file"
                                name="document"
                                accept="application/pdf"
                                required
                                class="w-full"
                            />
                            <x-uikit.inputs.input-error :messages="$errors->get('document')" class="mt-2" />
                        </div>

                        <x-uikit.buttons.primary-spinner-button id="documentUploadButton" class="w-full sm:w-auto h-10 sm:h-8 flex-shrink-0">
                            {{ __('documents.uploads.button') }}
                        </x-uikit.buttons.primary-spinner-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
