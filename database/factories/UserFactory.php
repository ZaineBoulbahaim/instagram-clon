<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Defineix l'estat per defecte del model User.
     * Genera dades falses però realistes per a cada usuari.
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->firstName(),
            'surname'           => fake()->lastName(),
            'nick'              => fake()->unique()->userName(),
            'role'              => 'user',
            'image'             => null, // Es pot afegir una imatge per defecte
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => Hash::make('password'), // Contrasenya per defecte per a tots
            'phone_number'      => fake()->phoneNumber(),
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Estat per a usuaris no verificats.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}