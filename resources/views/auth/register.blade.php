<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text"
                name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Cognom -->
        <div class="mt-4">
            <x-input-label for="surname" :value="__('Cognom')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text"
                name="surname" :value="old('surname')" required />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Nick -->
        <div class="mt-4">
            <x-input-label for="nick" :value="__('Nom d\'usuari (nick)')" />
            <x-text-input id="nick" class="block mt-1 w-full" type="text"
                name="nick" :value="old('nick')" required />
            <x-input-error :messages="$errors->get('nick')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email"
                name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Telèfon -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Telèfon (opcional)')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="tel"
                name="phone_number" :value="old('phone_number')" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Contrasenya -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contrasenya')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Contrasenya -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contrasenya')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botó de registre -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Ja tens compte?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Registrar-se') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>