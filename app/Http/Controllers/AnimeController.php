<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeUsuario;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    //novo
    public function show($id)
    {
        $anime = Anime::findOrFail($id);
        $avaliacoes = $anime->usuarios()->get();
        $mediaNotas = $avaliacoes->avg('pivot.NotaAnime');
        

        return view('anime.animePagina', compact('anime', 'avaliacoes', 'mediaNotas'));
    }
    // Exibe o formulário para cadastrar um novo anime
    public function create()
    {
        return view('anime.create');
    }

    public function index()
    {
        $recentAnimes = Anime::orderBy('created_at', 'desc')->take(5)->get();
        $animes = Anime::all(); // ou a lógica para pegar apenas os animes para avaliação
        return view('anime.todos', compact('recentAnimes','animes'));
    }

    // Armazena o anime no banco de dados com a imagem
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'titulo' => 'required|string|max:255',
            'resumo' => 'required|string',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validação da imagem
            'data_lancamento' => 'required|date',
        ]);

        // Processamento da imagem
        $imagemPath = $request->file('imagem')->store('public/imagens');

        // Criação do novo anime
        Anime::create([
            'titulo' => $request->titulo,
            'resumo' => $request->resumo,
            'imagem_url' => $imagemPath, // Caminho da imagem no servidor
            'data_lancamento' => $request->data_lancamento,
        ]);

        return redirect()->route('home')->with('success', 'Anime cadastrado com sucesso!');
    }

    public function avaliar($id)
    {
        $anime = Anime::find($id);
        return view('anime.avaliar', compact('anime'));
    }

    // Salva a avaliação feita pelo usuário
    public function salvarAvaliacao(Request $request, $id)
    {
        $request->validate([
            'nota' => 'required|integer|between:1,5',
            'opiniao' => 'required|string',
        ]);

        $avaliacao = new AnimeUsuario();
        $avaliacao->idUsuario = auth()->id(); // Considerando que o usuário está logado
        $avaliacao->idAnime = $id;
        $avaliacao->NotaAnime = $request->nota;
        $avaliacao->Opinião = $request->opiniao;
        $avaliacao->save();

        return redirect()->route('anime.avaliar', ['id' => $id])->with('success', 'Avaliação salva com sucesso!');
    }

}
