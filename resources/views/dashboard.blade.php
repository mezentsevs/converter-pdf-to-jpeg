<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('app.name') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="flex justify-between" method="POST" action="{{ route('document.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="inline-block sm:ml-5 lg:ml-5">
                            <x-input-label for="document" :value="__('documents.uploads.label')" />
                            <x-file-input id="document" type="file" name="document" accept="application/pdf" required />
                            <x-input-error :messages="$errors->get('document')" class="mt-2" />
                        </div>

                        <x-primary-button class="mt-5 sm:m-5 lg:m-5 h-8">
                            {{ __('documents.uploads.button') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
