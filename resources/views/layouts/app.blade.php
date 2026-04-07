<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Títol dinàmic de la pàgina -->
    <title>{{ config('app.name', 'Instagram Clone') }} - @yield('title', 'Inici')</title>

    <!-- Vite: carrega els assets CSS i JS compilats -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Navbar reutilitzable -->
    @include('includes.navbar')

    <!-- Contingut principal amb marge superior per la navbar fixa -->
    <main class="max-w-5xl mx-auto px-4 pt-20 pb-8">
        @yield('content')
    </main>

    <!-- Footer reutilitzable -->
    @include('includes.footer')

    <!-- Modal de confirmació reutilitzable per eliminar -->
    @include('includes.modal-confirm')

    <!-- Script global del modal de confirmació -->
    <script>
        /**
         * Gestió del modal de confirmació reutilitzable.
         * Qualsevol botó amb data-form="id-del-form" i data-message="missatge"
         * obrirà el modal i enviarà el formulari corresponent en confirmar.
         */
        const modal = document.getElementById('confirm-modal');
        const modalMessage = document.getElementById('modal-message');
        const modalConfirm = document.getElementById('modal-confirm');
        const modalCancel = document.getElementById('modal-cancel');
        let targetForm = null;

        // Escoltem tots els botons que tinguin data-form
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('[data-form]');
            if (btn) {
                e.preventDefault();
                // Obtenim el formulari i el missatge del botó
                targetForm = document.getElementById(btn.dataset.form);
                modalMessage.textContent = btn.dataset.message || 'Estàs segur?';
                // Mostrem el modal
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        });

        // Botó confirmar — envia el formulari
        modalConfirm.addEventListener('click', function() {
            if (targetForm) targetForm.submit();
        });

        // Botó cancel·lar — tanca el modal
        modalCancel.addEventListener('click', function() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            targetForm = null;
        });

        // Tancar el modal fent clic fora
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                targetForm = null;
            }
        });
    </script>

    <!-- Bloc per scripts addicionals per pàgina -->
    @stack('scripts')

</body>
</html>