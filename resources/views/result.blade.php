<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('app.name') }}
        </h2>
    </x-slot>

    @if(session('uploaded'))
        <x-message-success>{{ session('uploaded') }}</x-message-success>
    @endif

    @if(session('error'))
        <x-message-error>{{ session('error') }}</x-message-error>
    @endif

    @if(session('converted'))
        <x-message-success>{{ session('converted') }}</x-message-success>
    @endif

    @if(session('slides'))
        <x-slider></x-slider>
    @endif
</x-app-layout>
