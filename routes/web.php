<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;

// Ruta principal — mostra la pàgina de bienvenida
Route::get('/', function () {
    // Si l'usuari ja està autenticat, el redirigim al home directament
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return view('welcome');
});

// Totes les rutes protegides per autenticació
Route::middleware('auth')->group(function () {

    // Ruta del home — llista totes les imatges paginades
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // CRUD d'imatges
    Route::resource('images', ImageController::class);

    // Ruta per fer like/dislike d'una imatge (retorna JSON)
    Route::post('/images/{image}/like', [LikeController::class, 'toggle'])->name('likes.toggle');

    // CRUD de comentaris (sense index ni show ja que es mostren al detall de la imatge)
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Rutas del perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Rutas d'autenticació generades per Breeze
require __DIR__.'/auth.php';