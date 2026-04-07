<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la taula likes per emmagatzemar els likes de les imatges.
     */
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade'); // Si s'elimina l'usuari, s'eliminen els seus likes
            $table->foreignId('image_id')
                  ->constrained()
                  ->onDelete('cascade'); // Si s'elimina la imatge, s'eliminen els seus likes
            $table->timestamps();

            // Un usuari només pot fer like una vegada a cada imatge
            $table->unique(['user_id', 'image_id']);
        });
    }

    /**
     * Elimina la taula likes.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};