<!-- Modal de confirmació reutilitzable -->
<!-- Ús: afegir data-modal-target="nom-form" al botó d'eliminar -->
<div id="confirm-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-xl shadow-xl p-6 max-w-sm w-full mx-4">
        <h3 class="text-lg font-bold text-gray-800 mb-2">⚠️ Confirmar acció</h3>
        <p id="modal-message" class="text-gray-500 text-sm mb-6">Estàs segur que vols continuar?</p>
        <div class="flex justify-end gap-3">
            <!-- Botó de cancel·lar -->
            <button id="modal-cancel"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 text-sm">
                Cancel·lar
            </button>
            <!-- Botó de confirmar — envia el formulari corresponent -->
            <button id="modal-confirm"
                    class="px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 text-sm">
                Eliminar
            </button>
        </div>
    </div>
</div>