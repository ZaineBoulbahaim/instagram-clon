<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Defineix l'estat per defecte del model Like.
     */
    public function definition(): array
    {
        return [
            'user_id'  => 1, // Es sobreescriurà al seeder
            'image_id' => 1, // Es sobreescriurà al seeder
        ];
    }
}