<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Mostra el llistat de totes les imatges paginades.
     * Utilitza eager loading per evitar el problema N+1.
     */
    public function index()
    {
        // Obtenim totes les imatges amb l'usuari relacionat
        // ordenades de més nova a més antiga i paginades de 5 en 5
        $images = Image::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('home.index', compact('images'));
    }
}