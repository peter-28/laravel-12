<!-- Modal Form -->
<x-modal name="add-new-user" :show="$errors->addUser->isNotEmpty()" focusable>
    <form method="post" action="{{ route('users.store') }}" class="p-6">
        @csrf

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add New User') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Please fill in the details below to add a new user.') }}
        </p>

        <!-- Name Input -->
        <div class="mt-6">
            <x-input-label for="name" value="{{ __('Name') }}" />
            <x-text-input id="name" name="name" type="text" value="{{ old('name') }}"
                class="mt-1 block w-full" placeholder="{{ __('Name') }}" />
            <x-input-error :messages="$errors->addUser->get('name')" class="mt-2" />
        </div>

        <!-- Email Input -->
        <div class="mt-6">
            <x-input-label for="email" value="{{ __('Email') }}" />
            <x-text-input id="email" name="email" type="email" value="{{ old('email') }}"
                class="mt-1 block w-full" placeholder="{{ __('Email') }}" />
            <x-input-error :messages="$errors->addUser->get('email')" class="mt-2" />
        </div>

        <!-- Password Input -->
        <div class="mt-6">
            <x-input-label for="password" value="{{ __('Password') }}" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                placeholder="{{ __('Password') }}" />
            <x-input-error :messages="$errors->addUser->get('password')" class="mt-2" />
        </div>

        <!-- Password Confirmation Input -->
        <div class="mt-6">
            <x-input-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" placeholder="{{ __('Confirm Password') }}" />
            <x-input-error :messages="$errors->addUser->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Add User') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>
