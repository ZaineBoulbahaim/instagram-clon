<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Guarda un nou comentari a la base de dades.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validació dels camps
        $request->validate([
            'image_id' => ['required', 'exists:images,id'],
            'content'  => ['required', 'string', 'max:500'],
        ]);

        // Creem el comentari associat a l'usuari autenticat
        Comment::create([
            'user_id'  => auth()->id(),
            'image_id' => $request->image_id,
            'content'  => $request->content,
        ]);

        // Redirigim de tornada al detall de la imatge
        return redirect()->route('images.show', $request->image_id)
            ->with('success', 'Comentari afegit correctament!');
    }

    /**
     * Mostra el formulari per editar un comentari.
     * Només el propietari pot editar el seu comentari.
     */
    public function edit(Comment $comment): View
    {
        // Comprovem que l'usuari és el propietari del comentari
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'No tens permís per editar aquest comentari.');
        }

        return view('comments.edit', compact('comment'));
    }

    /**
     * Actualitza un comentari a la base de dades.
     * Només el propietari pot actualitzar el seu comentari.
     */
    public function update(Request $request, Comment $comment): RedirectResponse
    {
        // Comprovem que l'usuari és el propietari del comentari
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'No tens permís per editar aquest comentari.');
        }

        // Validació del contingut
        $request->validate([
            'content' => ['required', 'string', 'max:500'],
        ]);

        // Actualitzem el comentari
        $comment->update([
            'content' => $request->content,
        ]);

        // Redirigim de tornada al detall de la imatge
        return redirect()->route('images.show', $comment->image_id)
            ->with('success', 'Comentari actualitzat correctament!');
    }

    /**
     * Elimina un comentari de la base de dades.
     * Només el propietari pot eliminar el seu comentari.
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        // Comprovem que l'usuari és el propietari del comentari
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'No tens permís per eliminar aquest comentari.');
        }

        // Guardem l'image_id abans d'eliminar per redirigir
        $imageId = $comment->image_id;

        $comment->delete();

        return redirect()->route('images.show', $imageId)
            ->with('success', 'Comentari eliminat correctament!');
    }
}