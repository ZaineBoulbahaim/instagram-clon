@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">👤 Editar Perfil</h1>

    <!-- Missatge d'èxit -->
    @if(session('status') === 'profile-updated')
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            ✅ Perfil actualitzat correctament!
        </div>
    @endif

    <!-- Formulari d'edició del perfil -->
    <!-- enctype necessari per pujar fitxers (avatar) -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
          class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf
        @method('PATCH')

        <!-- Avatar actual i botó per canviar-lo -->
        <div class="flex items-center gap-4">
            @if($user->image)
                <img src="{{ asset('storage/' . $user->image) }}"
                     alt="Avatar"
                     class="w-20 h-20 rounded-full object-cover">
            @else
                <div class="w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-white text-2xl font-bold">
                    {{ getUserInitial($user) }}
                </div>
            @endif
            <div>
                <x-input-label for="image" :value="__('Canviar avatar')" />
                <input type="file" id="image" name="image" accept="image/*"
                       class="block mt-1 text-sm text-gray-500">
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
        </div>

        <!-- Nom -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text"
                name="name" :value="old('name', $user->name)" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Cognom -->
        <div>
            <x-input-label for="surname" :value="__('Cognom')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text"
                name="surname" :value="old('surname', $user->surname)" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Nick -->
        <div>
            <x-input-label for="nick" :value="__('Nom d\'usuari (nick)')" />
            <x-text-input id="nick" class="block mt-1 w-full" type="text"
                name="nick" :value="old('nick', $user->nick)" />
            <x-input-error :messages="$errors->get('nick')" class="mt-2" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email"
                name="email" :value="old('email', $user->email)" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Telèfon -->
        <div>
            <x-input-label for="phone_number" :value="__('Telèfon')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="tel"
                name="phone_number" :value="old('phone_number', $user->phone_number)" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Botó de guardar -->
        <div class="flex justify-end">
            <x-primary-button>
                💾 Guardar canvis
            </x-primary-button>
        </div>

    </form>

    <!-- Secció per eliminar el compte -->
    <div class="bg-white rounded-xl shadow p-6 mt-6">
        <h2 class="text-lg font-bold text-red-600 mb-4">⚠️ Zona de perill</h2>
        <p class="text-gray-500 text-sm mb-4">Un cop eliminat el compte, no es pot recuperar.</p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')
            <div>
                <x-input-label for="password_delete" :value="__('Contrasenya per confirmar')" />
                <x-text-input id="password_delete" class="block mt-1 w-full" type="password"
                    name="password" />
                <x-input-error :messages="$errors->getBag('userDeletion')->get('password')" class="mt-2" />
            </div>
            <div class="mt-4">
                <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                    onclick="return confirm('Estàs segur que vols eliminar el compte?')">
                    🗑️ Eliminar compte
                </button>
            </div>
        </form>
    </div>

</div>
@endsection