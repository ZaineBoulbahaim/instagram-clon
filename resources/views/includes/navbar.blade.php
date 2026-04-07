<!-- Navbar principal de l'aplicació -->
<nav class="bg-white border-b border-gray-200 fixed w-full z-50 top-0">
    <div class="max-w-5xl mx-auto px-4 flex items-center justify-between h-16">

        <!-- Logo / Nom de l'app -->
        <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight text-gray-800">
            📸 Instagram Clone
        </a>

        <!-- Menú de navegació (només per usuaris autenticats) -->
        @auth
        <div class="flex items-center gap-4">

            <!-- Enllaç al home -->
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">
                🏠 Inici
            </a>

            <!-- Enllaç per pujar imatge -->
            <a href="{{ route('images.create') }}" class="text-gray-600 hover:text-gray-900">
                ➕ Pujar
            </a>

            <!-- Avatar i nom d'usuari amb enllaç al perfil -->
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900">
                @if(auth()->user()->image)
                    <img src="{{ asset('storage/' . auth()->user()->image) }}"
                         alt="Avatar"
                         class="w-8 h-8 rounded-full object-cover">
                @else
                    <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-sm font-bold">
                        {{ strtoupper(substr(auth()->user()->nick ?? auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <span>{{ auth()->user()->nick ?? auth()->user()->name }}</span>
            </a>

            <!-- Botó de logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-600 hover:text-red-500">
                    🚪 Sortir
                </button>
            </form>
        </div>
        @endauth

        <!-- Menú per usuaris no autenticats -->
        @guest
        <div class="flex items-center gap-4">
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Login</a>
            <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Register</a>
        </div>
        @endguest

    </div>
</nav>