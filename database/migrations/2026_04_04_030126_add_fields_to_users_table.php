<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Afegeix els camps addicionals a la taula users.
     * S'afegeixen: role, surname, nick, image i phone_number
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->nullable()->after('name');         // Cognom de l'usuari
            $table->string('nick')->unique()->nullable()->after('surname'); // Nom d'usuari únic
            $table->string('role')->default('user')->after('nick');       // Rol: 'user' o 'admin'
            $table->string('image')->nullable()->after('role');           // Ruta de l'avatar
            $table->string('phone_number')->nullable()->after('email');   // Telèfon opcional
        });
    }

    /**
     * Reverteix els canvis fets al mètode up().
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['surname', 'nick', 'role', 'image', 'phone_number']);
        });
    }
};