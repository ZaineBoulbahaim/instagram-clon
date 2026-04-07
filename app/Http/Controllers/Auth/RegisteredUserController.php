<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Mostra el formulari de registre.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Processa el formulari de registre.
     * Valida els camps, crea l'usuari i fa login automàtic.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validació de tots els camps del formulari
        $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'surname'      => ['required', 'string', 'max:255'],
            'nick'         => ['required', 'string', 'max:255', 'unique:users'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['nullable', 'string', 'min:9', 'max:15'],
        ]);

        // Crear l'usuari amb els camps validats
        $user = User::create([
            'name'         => $request->name,
            'surname'      => $request->surname,
            'nick'         => $request->nick,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'role'         => 'user',
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirigim al home després del registre
        return redirect()->route('home');
    }
}