<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la taula comments per emmagatzemar els comentaris de les imatges.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade'); // Si s'elimina l'usuari, s'eliminen els seus comentaris
            $table->foreignId('image_id')
                  ->constrained()
                  ->onDelete('cascade'); // Si s'elimina la imatge, s'eliminen els seus comentaris
            $table->text('content');                   // Contingut del comentari
            $table->timestamps();
        });
    }

    /**
     * Elimina la taula comments.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};