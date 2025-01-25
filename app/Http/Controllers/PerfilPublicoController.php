<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PerfilPublicoController extends Controller
{
    /**
     * Exibe o perfil público de um usuário.
     */
    public function show($id)
    {
        // Encontra o usuário pelo ID
        $user = User::findOrFail($id);

        // Busca os animes avaliados pelo usuário
        $animesAvaliados = $user->animes()->withPivot('NotaAnime', 'Opinião')->get();

        // Retorna a view do perfil público
        return view('perfilPublico', compact('user', 'animesAvaliados'));
    }
}
