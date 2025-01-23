<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime; // Certifique-se de importar o modelo Anime

class HomeController extends Controller
{
    public function showHome()
    {
        if (!auth()->check()) {
            // Se o usuário não estiver autenticado, redireciona para a página de login
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar seus animes avaliados.');
        }
    
        // Obtém os 5 últimos animes adicionados
        $recentAnimes = Anime::orderBy('created_at', 'desc')->take(5)->get();
    
        // Obtém os animes avaliados pelo usuário logado
        $animesAvaliados = auth()->user()->animes;  // Obtém os animes que o usuário avaliou
    
        // Retorna a view com os animes recentes e os animes avaliados
        return view('home', compact('recentAnimes', 'animesAvaliados'));
    }
}

