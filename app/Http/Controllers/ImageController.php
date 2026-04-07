<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ImageController extends Controller
{
    /**
     * Mostra el formulari per pujar una nova imatge.
     */
    public function create(): View
    {
        return view('images.create');
    }

    /**
     * Guarda una nova imatge a la base de dades i a l'storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validació dels camps del formulari
        $request->validate([
            'image'       => ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:4096'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        // Guardem la imatge a storage/app/public/images
        $imagePath = $request->file('image')->store('images', 'public');

        // Creem el registre a la base de dades
        Image::create([
            'user_id'     => auth()->id(),
            'image_path'  => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('home')->with('success', 'Imatge pujada correctament!');
    }

    /**
     * Mostra el detall d'una imatge amb els seus comentaris i likes.
     */
    public function show(Image $image): View
    {
        // Carreguem les relacions necessàries amb eager loading
        $image->load([
            'user',
            'comments.user', // Comentaris amb l'usuari de cada comentari
            'likes',
        ]);

        // Ordenem els comentaris de més antic a més nou
        $comments = $image->comments->sortBy('created_at');

        // Comprovem si l'usuari autenticat ja ha fet like
        $userLiked = $image->likes->contains('user_id', auth()->id());

        return view('images.show', compact('image', 'comments', 'userLiked'));
    }

    /**
     * Mostra el formulari per editar una imatge.
     * Només el propietari pot editar la seva imatge.
     */
    public function edit(Image $image): View
    {
        // Comprovem que l'usuari és el propietari
        if ($image->user_id !== auth()->id()) {
            abort(403, 'No tens permís per editar aquesta imatge.');
        }

        return view('images.edit', compact('image'));
    }

    /**
     * Actualitza una imatge a la base de dades.
     * Només el propietari pot actualitzar la seva imatge.
     */
    public function update(Request $request, Image $image): RedirectResponse
    {
        // Comprovem que l'usuari és el propietari
        if ($image->user_id !== auth()->id()) {
            abort(403, 'No tens permís per editar aquesta imatge.');
        }

        // Validació dels camps
        $request->validate([
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:4096'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        // Si s'ha pujat una nova imatge, substituïm l'antiga
        if ($request->hasFile('image')) {
            // Eliminem la imatge antiga de l'storage
            Storage::disk('public')->delete($image->image_path);
            // Guardem la nova imatge
            $image->image_path = $request->file('image')->store('images', 'public');
        }

        // Actualitzem la descripció
        $image->description = $request->description;
        $image->save();

        return redirect()->route('images.show', $image->id)
            ->with('success', 'Imatge actualitzada correctament!');
    }

    /**
     * Elimina una imatge de la base de dades i de l'storage.
     * Només el propietari pot eliminar la seva imatge.
     */
    public function destroy(Image $image): RedirectResponse
    {
        // Comprovem que l'usuari és el propietari
        if ($image->user_id !== auth()->id()) {
            abort(403, 'No tens permís per eliminar aquesta imatge.');
        }

        // Eliminem la imatge de l'storage
        Storage::disk('public')->delete($image->image_path);

        // Eliminem el registre de la base de dades
        $image->delete();

        return redirect()->route('home')->with('success', 'Imatge eliminada correctament!');
    }
}