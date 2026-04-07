@extends('layouts.app')

@section('title', 'Detall imatge')

@section('content')
<div class="max-w-2xl mx-auto">

    <!-- Missatge d'èxit -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Targeta de la imatge -->
    <div class="bg-white rounded-xl shadow overflow-hidden mb-6">

        <!-- Capçalera: avatar i nom d'usuari -->
        <div class="flex items-center justify-between p-4">
            <div class="flex items-center gap-3">
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

            <!-- Botons editar/eliminar només per al propietari -->
            @if(auth()->id() === $image->user_id)
            <div class="flex gap-2 items-center">
                <a href="{{ route('images.edit', $image->id) }}"
                   class="text-blue-500 hover:text-blue-700 text-sm">✏️ Editar</a>

                <!-- Formulari d'eliminar imatge — id necessari per al modal -->
                <form id="delete-image-form" method="POST" action="{{ route('images.destroy', $image->id) }}">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button"
                        data-form="delete-image-form"
                        data-message="Estàs segur que vols eliminar aquesta imatge? Aquesta acció no es pot desfer."
                        class="text-red-500 hover:text-red-700 text-sm">
                    🗑️ Eliminar
                </button>
            </div>
            @endif
        </div>

        <!-- Imatge -->
        <img src="{{ asset('storage/' . $image->image_path) }}"
             alt="Publicació"
             class="w-full object-cover">

        <!-- Peu: likes i descripció -->
        <div class="p-4">

            <!-- Botó de like reactiu -->
            <div class="flex items-center gap-4 mb-3">
                <button id="like-btn"
                        data-image-id="{{ $image->id }}"
                        data-liked="{{ $userLiked ? 'true' : 'false' }}"
                        class="text-2xl focus:outline-none transition-transform hover:scale-110">
                    {{ $userLiked ? '❤️' : '🤍' }}
                </button>
                <span id="likes-count" class="text-gray-600 font-semibold">
                    {{ $image->likes->count() }} likes
                </span>
            </div>

            <!-- Descripció -->
            @if($image->description)
                <p class="text-gray-700 text-sm mb-3">
                    <span class="font-semibold">{{ $image->user->nick ?? $image->user->name }}</span>
                    {{ $image->description }}
                </p>
            @endif

            <!-- Comentaris -->
            <div class="border-t pt-3">
                <h3 class="font-semibold text-gray-700 mb-3">
                    💬 Comentaris ({{ $comments->count() }})
                </h3>

                @forelse($comments as $comment)
                <div class="flex items-start gap-2 mb-3" id="comment-{{ $comment->id }}">

                    <!-- Avatar del comentarista -->
                    @if($comment->user->image)
                        <img src="{{ asset('storage/' . $comment->user->image) }}"
                             alt="Avatar"
                             class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                    @else
                        <div class="w-8 h-8 rounded-full bg-gray-400 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                            {{ getUserInitial($comment->user) }}
                        </div>
                    @endif

                    <div class="flex-1">
                        <p class="text-sm">
                            <span class="font-semibold">{{ $comment->user->nick ?? $comment->user->name }}</span>
                            {{ $comment->content }}
                        </p>
                        <p class="text-xs text-gray-400">{{ formatDate($comment->created_at) }}</p>

                        <!-- Botons editar/eliminar comentari només per al propietari -->
                        @if(auth()->id() === $comment->user_id)
                        <div class="flex gap-2 mt-1">
                            <a href="{{ route('comments.edit', $comment->id) }}"
                               class="text-blue-400 text-xs hover:underline">Editar</a>

                            <!-- Formulari d'eliminar comentari — id únic per cada comentari -->
                            <form id="delete-comment-{{ $comment->id }}" method="POST"
                                  action="{{ route('comments.destroy', $comment->id) }}">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button"
                                    data-form="delete-comment-{{ $comment->id }}"
                                    data-message="Estàs segur que vols eliminar aquest comentari?"
                                    class="text-red-400 text-xs hover:underline">
                                Eliminar
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                    <p class="text-gray-400 text-sm">Encara no hi ha comentaris.</p>
                @endforelse
            </div>

            <!-- Formulari per afegir comentari -->
            <form method="POST" action="{{ route('comments.store') }}" class="mt-4 flex gap-2">
                @csrf
                <input type="hidden" name="image_id" value="{{ $image->id }}">
                <input type="text" name="content" placeholder="Afegeix un comentari..."
                       required
                       class="flex-1 border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm hover:bg-blue-600">
                    Enviar
                </button>
            </form>

        </div>
    </div>

    <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">← Tornar al inici</a>

</div>
@endsection

@push('scripts')
<script>
    /**
     * Sistema de likes reactiu amb Fetch API.
     * Fa toggle del like sense recarregar la pàgina.
     */
    const likeBtn = document.getElementById('like-btn');
    const likesCount = document.getElementById('likes-count');

    likeBtn.addEventListener('click', async function() {
        const imageId = this.dataset.imageId;

        try {
            // Fem la petició al servidor per fer toggle del like
            const response = await fetch(`/images/${imageId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });

            const data = await response.json();

            // Actualitzem el botó i el comptador sense recarregar
            if (data.liked) {
                likeBtn.textContent = '❤️';
                likeBtn.dataset.liked = 'true';
            } else {
                likeBtn.textContent = '🤍';
                likeBtn.dataset.liked = 'false';
            }

            likesCount.textContent = `${data.count} likes`;

        } catch (error) {
            console.error('Error al fer like:', error);
        }
    });
</script>
@endpush