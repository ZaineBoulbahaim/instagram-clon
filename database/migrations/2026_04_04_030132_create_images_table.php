<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la taula images per emmagatzemar les publicacions dels usuaris.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade'); // Si s'elimina l'usuari, s'eliminen les seves imatges
            $table->string('image_path');              // Ruta de la imatge a l'storage
            $table->text('description')->nullable();   // Descripció opcional de la imatge
            $table->timestamps();
        });
    }

    /**
     * Elimina la taula images.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};