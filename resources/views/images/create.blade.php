@extends('layouts.app')

@section('title', 'Pujar imatge')

@section('content')
<div class="max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">➕ Pujar nova imatge</h1>

    <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data"
          class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf

        <!-- Camp per seleccionar la imatge -->
        <div>
            <x-input-label for="image" :value="__('Selecciona una imatge')" />
            <input type="file" id="image" name="image" accept="image/*" required
                   class="block mt-1 w-full text-sm text-gray-500 border border-gray-300 rounded p-2">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <!-- Previsualització de la imatge abans de pujar -->
        <div id="preview-container" class="hidden">
            <p class="text-sm text-gray-500 mb-1">Previsualització:</p>
            <img id="image-preview" src="" alt="Preview"
                 class="max-h-64 rounded-lg object-cover">
        </div>

        <!-- Descripció opcional -->
        <div>
            <x-input-label for="description" :value="__('Descripció (opcional)')" />
            <textarea id="description" name="description" rows="3"
                      class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                      placeholder="Escriu una descripció...">{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Botons -->
        <div class="flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">
                ← Tornar
            </a>
            <x-primary-button>
                📤 Pujar imatge
            </x-primary-button>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script>
    // Previsualització de la imatge abans de pujar
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush