<x-app-layout>
    <x-slot name="header">
        <h2 class="text-gray-800 dark:text-gray-200 text-xl font-semibold leading-tight">
            {{ __('app.name') }}
        </h2>
    </x-slot>

    <div class="pb-8">
        @if(session('uploaded'))
            <x-uikit.messages.message-success>{{ session('uploaded') }}</x-uikit.messages.message-success>
        @endif

        @if(session('error'))
            <x-uikit.messages.message-error>{{ session('error') }}</x-uikit.messages.message-error>
        @endif

        @if(session('converted'))
            <x-uikit.messages.message-success>{{ session('converted') }}</x-uikit.messages.message-success>
        @endif

        @if(session('slides'))
            <x-slider.slider />
        @endif
    </div>
</x-app-layout>
