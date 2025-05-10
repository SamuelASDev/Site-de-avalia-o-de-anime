<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerfilPublicoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;

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


Route::delete('/anime/{id}', function($id) {
    if (auth()->check() && auth()->user()->nivel !== 'admin') {
        return redirect('/');  // Redireciona para a página inicial se não for admin
    }
    // Chama o método de destroy do controller
    return app(AdminController::class)->destroy($id);
})->name('anime.destroy');

Route::get('/anime/{id}/edit', function($id) {
    if (auth()->check() && auth()->user()->nivel !== 'admin') {
        return redirect('/');  // Redireciona para a página inicial se não for admin
    }
    // Chama o método de edit do controller
    return app(AdminController::class)->edit($id);
})->name('anime.edit');

Route::put('/anime/{id}', function($id) {
    if (auth()->check() && auth()->user()->nivel !== 'admin') {
        return redirect('/');  // Redireciona para a página inicial se não for admin
    }
    // Chama o método de update do controller
    return app(AdminController::class)->update(request(), $id);
})->name('anime.update');

Route::get('/admin/dashboard', function() {
    if (auth()->check() && auth()->user()->nivel !== 'admin') {
        return redirect('/');  // Redireciona para a página inicial se não for admin
    }
    // Chama o método de dashboard do controller
    return app(AdminController::class)->dashboard();
})->name('adm.dashboard');


// Rotas para usuários (protegidas por middleware admin)
Route::get('/usuario/{usuario}/edit', function ($usuario) {
    if (auth()->check() && auth()->user()->nivel !== 'admin') {
        return redirect('/');  // Redireciona para a página inicial se não for admin
    }
    return app(UsuarioController::class)->edit($usuario); // Chama a função de editar
})->name('usuario.edit');

Route::put('/usuario/{usuario}', function ($usuario) {
    if (auth()->check() && auth()->user()->nivel !== 'admin') {
        return redirect('/');  // Redireciona para a página inicial se não for admin
    }
    return app(UsuarioController::class)->update(request(), $usuario); // Chama a função de atualizar
})->name('usuario.update');

Route::delete('/usuario/{usuario}', function ($usuario) {
    if (auth()->check() && auth()->user()->nivel !== 'admin') {
        return redirect('/');  // Redireciona para a página inicial se não for admin
    }
    return app(UsuarioController::class)->destroy($usuario); // Chama a função de remover
})->name('usuario.destroy');
