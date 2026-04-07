<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Defineix l'estat per defecte del model Image.
     * Genera dades falses per a cada imatge.
     */
    public function definition(): array
    {
        return [
            'user_id'     => 1, // Es sobreescriurà al seeder
            'image_path'  => 'images/default.jpg', // Es sobreescriurà al seeder
            'description' => fake()->sentence(10),
        ];
    }
}