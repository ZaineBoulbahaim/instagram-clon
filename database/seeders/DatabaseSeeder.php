<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Like;

class DatabaseSeeder extends Seeder
{
    /**
     * Pobla la base de dades amb dades de prova.
     * Crea usuaris, imatges, comentaris i likes relacionats.
     */
    public function run(): void
    {
        // Creem 5 usuaris de prova
        User::factory(5)->create()->each(function ($user) {

            // Per cada usuari creem 3 imatges
            for ($i = 1; $i <= 3; $i++) {

                // Seleccionem una imatge aleatoria dels arxius que hem pujat
                $imageNumber = rand(1, 10);

                $image = Image::create([
                    'user_id'     => $user->id,
                    'image_path'  => 'images/' . $imageNumber . '.jpg',
                    'description' => fake()->sentence(10),
                ]);

                // Per cada imatge creem entre 2 i 5 comentaris d'usuaris aleatoris
                $numComments = rand(2, 5);
                for ($j = 0; $j < $numComments; $j++) {
                    Comment::create([
                        'user_id'  => User::inRandomOrder()->first()->id,
                        'image_id' => $image->id,
                        'content'  => fake()->sentence(8),
                    ]);
                }

                // Per cada imatge creem entre 1 i 4 likes d'usuaris aleatoris (sense repetir)
                $usersWhoLiked = User::inRandomOrder()->take(rand(1, 4))->get();
                foreach ($usersWhoLiked as $likeUser) {
                    // Comprovem que no existeix ja un like d'aquest usuari a aquesta imatge
                    Like::firstOrCreate([
                        'user_id'  => $likeUser->id,
                        'image_id' => $image->id,
                    ]);
                }
            }
        });

        // Creem un usuari de prova fix per poder fer login fàcilment
        User::factory()->create([
            'name'    => 'Test',
            'surname' => 'User',
            'nick'    => 'testuser',
            'email'   => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}