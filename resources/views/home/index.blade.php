@extends('layouts.app')

@section('title', 'Inici')

@section('content')
<!-- Missatge d'èxit -->
@if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4 max-w-2xl mx-auto">
        ✅ {{ session('success') }}
    </div>
@endif
<div class="max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">📸 Totes les publicacions</h1>

    @forelse($images as $image)
    <!-- Targeta de cada imatge -->
    <div class="bg-white rounded-xl shadow mb-6 overflow-hidden">

        <!-- Capçalera: avatar i nom d'usuari -->
        <div class="flex items-center gap-3 p-4">
            @if($image->user->image)
                <img src="{{ asset('storage/' . $image->user->image) }}"
                     alt="Avatar"
                     class="w-10 h-10 rounded-full object-cover">
            @else
                <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                    {{ getUserInitial($image->user) }}
                </div>
            @endif
            <div>
                <p class="font-semibold text-gray-800">{{ $image->user->nick ?? $image->user->name }}</p>
                <p class="text-xs text-gray-400">{{ formatDate($image->created_at) }}</p>
            </div>
        </div>

        <!-- Imatge -->
        <a href="{{ route('images.show', $image->id) }}">
            <img src="{{ asset('storage/' . $image->image_path) }}"
                 alt="Publicació"
                 class="w-full object-cover max-h-96">
        </a>

        <!-- Peu: likes, comentaris i descripció -->
        <div class="p-4">
            <div class="flex items-center gap-4 text-gray-500 text-sm mb-2">
                <span>❤️ {{ $image->likes->count() }} likes</span>
                <span>💬 {{ $image->comments->count() }} comentaris</span>
            </div>
            @if($image->description)
                <p class="text-gray-700 text-sm">
                    <span class="font-semibold">{{ $image->user->nick ?? $image->user->name }}</span>
                    {{ $image->description }}
                </p>
            @endif
            <a href="{{ route('images.show', $image->id) }}" class="text-blue-500 text-sm hover:underline mt-1 block">
                Veure tots els comentaris
            </a>
        </div>

    </div>
    @empty
        <p class="text-center text-gray-400">No hi ha publicacions encara.</p>
    @endforelse

    <!-- Paginació -->
    <div class="mt-4">
        {{ $images->links() }}
    </div>

</div>
@endsection