<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Clone — Benvingut</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Navbar simplificada per a la pàgina de bienvenida -->
    <nav class="bg-white border-b border-gray-200 fixed w-full z-50 top-0">
        <div class="max-w-5xl mx-auto px-4 flex items-center justify-between h-16">
            <span class="text-2xl font-bold tracking-tight text-gray-800">📸 Instagram Clone</span>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="text-gray-600 hover:text-gray-900 font-medium px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                    Iniciar sessió
                </a>
                <a href="{{ route('register') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-lg transition">
                    Registrar-se
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero principal -->
    <main class="pt-16">

        <!-- Secció hero -->
        <section class="max-w-5xl mx-auto px-4 py-24 flex flex-col md:flex-row items-center gap-12">

            <!-- Text esquerra -->
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-5xl font-extrabold text-gray-900 leading-tight mb-4">
                    Comparteix els teus<br>
                    <span class="text-blue-500">millors moments</span>
                </h1>
                <p class="text-gray-500 text-lg mb-8">
                    Puja fotos, connecta amb altres usuaris,<br>
                    comenta i dona like al contingut que t'agrada.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                    <a href="{{ route('register') }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-8 py-3 rounded-xl text-lg transition shadow-md">
                        Crear compte gratis
                    </a>
                    <a href="{{ route('login') }}"
                       class="border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold px-8 py-3 rounded-xl text-lg transition">
                        Iniciar sessió
                    </a>
                </div>
            </div>

            <!-- Mockup dreta — targetes de previsualització -->
            <div class="flex-1 flex justify-center">
                <div class="relative w-72">

                    <!-- Targeta principal -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="flex items-center gap-3 p-4 border-b">
                            <div class="w-9 h-9 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm">J</div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">joan_photos</p>
                                <p class="text-xs text-gray-400">fa 2 minuts</p>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-blue-100 to-purple-100 h-48 flex items-center justify-center">
                            <span class="text-6xl">🏔️</span>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-xl">❤️</span>
                                <span class="text-sm text-gray-500 font-medium">124 likes</span>
                                <span class="text-xl">💬</span>
                                <span class="text-sm text-gray-500 font-medium">8 comentaris</span>
                            </div>
                            <p class="text-sm text-gray-700">
                                <span class="font-semibold">joan_photos</span>
                                Meravellosa escapada a la muntanya! 🌿
                            </p>
                        </div>
                    </div>

                    <!-- Targeta flotant decorativa -->
                    <div class="absolute -bottom-4 -right-6 bg-white rounded-2xl shadow-lg p-3 flex items-center gap-2">
                        <span class="text-2xl">🤍</span>
                        <div>
                            <p class="text-xs font-semibold text-gray-700">Nou like!</p>
                            <p class="text-xs text-gray-400">maria_garcia</p>
                        </div>
                    </div>

                </div>
            </div>

        </section>

        <!-- Secció de característiques -->
        <section class="bg-white border-t border-gray-100 py-16">
            <div class="max-w-5xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                    Tot el que necessites
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    <!-- Feature 1 -->
                    <div class="text-center p-6 rounded-2xl hover:bg-gray-50 transition">
                        <div class="text-5xl mb-4">📸</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Puja fotos</h3>
                        <p class="text-gray-500 text-sm">
                            Comparteix les teves millors fotografies amb tots els usuaris de la plataforma.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="text-center p-6 rounded-2xl hover:bg-gray-50 transition">
                        <div class="text-5xl mb-4">❤️</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Dona likes</h3>
                        <p class="text-gray-500 text-sm">
                            Interactua amb el contingut que t'agrada de forma instantània i reactiva.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="text-center p-6 rounded-2xl hover:bg-gray-50 transition">
                        <div class="text-5xl mb-4">💬</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Comenta</h3>
                        <p class="text-gray-500 text-sm">
                            Deixa els teus comentaris i connecta amb la comunitat d'usuaris.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- Crida a l'acció final -->
        <section class="py-16">
            <div class="max-w-xl mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">
                    Llest per començar?
                </h2>
                <p class="text-gray-500 mb-8">
                    Uneix-te a la comunitat i comença a compartir els teus moments avui mateix.
                </p>
                <a href="{{ route('register') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-10 py-4 rounded-xl text-lg transition shadow-md inline-block">
                    Crear compte gratis
                </a>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-5xl mx-auto px-4 text-center text-gray-400 text-sm">
            <p>© {{ date('Y') }} Instagram Clone — Projecte Laravel 12</p>
        </div>
    </footer>

</body>
</html>