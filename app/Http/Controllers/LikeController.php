<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    /**
     * Fa toggle del like d'una imatge.
     * Si ja existeix el like l'elimina, si no existeix el crea.
     * Retorna JSON per al sistema reactiu de JavaScript.
     */
    public function toggle(Request $request, Image $image): JsonResponse
    {
        $userId = auth()->id();

        // Busquem si ja existeix un like d'aquest usuari a aquesta imatge
        $like = Like::where('user_id', $userId)
                    ->where('image_id', $image->id)
                    ->first();

        if ($like) {
            // Si ja existeix el like, l'eliminem (dislike)
            $like->delete();
            $liked = false;
        } else {
            // Si no existeix, el creem (like)
            Like::create([
                'user_id'  => $userId,
                'image_id' => $image->id,
            ]);
            $liked = true;
        }

        // Retornem el nou estat i el nombre total de likes en format JSON
        return response()->json([
            'liked' => $liked,
            'count' => $image->likes()->count(),
        ]);
    }
}