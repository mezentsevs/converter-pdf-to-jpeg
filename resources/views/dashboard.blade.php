<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ config('app.name', 'Converter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('document.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="inline-block">
                            <x-input-label for="document" :value="__('documents.uploads.label')" />
                            <input type="hidden" name="MAX_FILE_SIZE" value="{{ config('uploads.post.max_file_size') }}">
                            <x-file-input id="document" type="file" name="document" accept="application/pdf" required />
                            <x-input-error :messages="$errors->get('document')" class="mt-2" />
                        </div>

                        <x-primary-button class="ml-5">
                            {{ __('documents.uploads.button') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
