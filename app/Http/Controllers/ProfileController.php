<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Mostra el formulari d'edició del perfil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Actualitza la informació del perfil de l'usuari.
     * Gestiona també la pujada de l'avatar.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Omplim els camps validats
        $user->fill($request->validated());

        // Si l'email ha canviat, resetegem la verificació
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Gestionem la pujada de l'avatar si s'ha enviat un fitxer
        if ($request->hasFile('image')) {
            // Eliminem l'avatar antic si existeix
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            // Guardem el nou avatar a storage/app/public/avatars
            $user->image = $request->file('image')->store('avatars', 'public');
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina el compte de l'usuari.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Eliminem l'avatar de l'storage si existeix
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}