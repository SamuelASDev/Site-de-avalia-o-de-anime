<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PerfilPublicoController;
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout(); 
    return redirect('/'); 
})->name('logout');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/', [HomeController::class, 'showHome'])->name('home');

Route::get('/anime/create', [AnimeController::class, 'create'])->name('anime.create');;
Route::post('/anime', [AnimeController::class, 'store'])->name('anime.store');
Route::get('/animes', [AnimeController::class, 'index'])->name('anime.todos');

//nova
Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');

Route::get('/anime/{id}/avaliar', [AnimeController::class, 'avaliar'])->name('anime.avaliar');
Route::post('/anime/{id}/avaliar', [AnimeController::class, 'salvarAvaliacao'])->name('anime.salvarAvaliacoes');



Route::get('/usuarios/{id}', [PerfilPublicoController::class, 'show'])->name('usuarios.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::post('/perfil/upload-imagem', [PerfilController::class, 'uploadImagem'])->name('perfil.uploadImagem');
});
