<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-uikit.inputs.input-label for="password" :value="__('Password')" />

            <x-uikit.inputs.text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-uikit.inputs.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-uikit.buttons.primary-button>
                {{ __('Confirm') }}
            </x-uikit.buttons.primary-button>
        </div>
    </form>
</x-guest-layout>
