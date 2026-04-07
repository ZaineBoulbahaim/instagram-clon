<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Defineix l'estat per defecte del model Comment.
     * Genera contingut fals per a cada comentari.
     */
    public function definition(): array
    {
        return [
            'user_id'  => 1, // Es sobreescriurà al seeder
            'image_id' => 1, // Es sobreescriurà al seeder
            'content'  => fake()->sentence(8),
        ];
    }
}