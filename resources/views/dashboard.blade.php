<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 dark:text-gray-200 text-xl font-semibold leading-tight">
            {{ __('app.name') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-12">
        <div class="p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden sm:rounded-lg shadow-sm">
            <form
                id="documentUploadForm"
                method="POST"
                action="{{ route('document.store') }}"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="flex flex-col">
                    <x-input-label for="document" :value="__('documents.uploads.label')" />

                    <div class="mt-1 flex">
                        <div class="min-w-48 mr-4 flex-1">
                            <x-file-input
                                id="document"
                                type="file"
                                name="document"
                                accept="application/pdf"
                                required
                                class="w-full"
                            />
                            <x-input-error :messages="$errors->get('document')" class="mt-2" />
                        </div>

                        <x-primary-spinner-button id="documentUploadButton" class="h-8 flex-shrink-0">
                            {{ __('documents.uploads.button') }}
                        </x-primary-spinner-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
