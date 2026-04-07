@extends('layouts.app')

@section('title', 'Editar comentari')

@section('content')
<div class="max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">✏️ Editar comentari</h1>

    <form method="POST" action="{{ route('comments.update', $comment->id) }}"
          class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf
        @method('PUT')

        <!-- Contingut del comentari -->
        <div>
            <x-input-label for="content" :value="__('Comentari')" />
            <textarea id="content" name="content" rows="3" required
                      class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">{{ old('content', $comment->content) }}</textarea>
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <!-- Botons -->
        <div class="flex justify-between items-center">
            <a href="{{ route('images.show', $comment->image_id) }}"
               class="text-gray-500 hover:text-gray-700">
                ← Tornar
            </a>
            <x-primary-button>
                💾 Guardar canvis
            </x-primary-button>
        </div>

    </form>
</div>
@endsection