<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeUsuario;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Verifica se o usuário autenticado tem o nível 'admin'
        if (auth()->check() && auth()->user()->nivel !== 'admin') {
            return redirect('/');  // Redireciona para a página inicial se não for admin
        }

        // Caso o usuário seja admin, prossegue com a lógica do Dashboard
        return view('adm.dashboard');
    }

    public function dashboard()
    {
        // Obtém todos os animes cadastrados
        $animes = Anime::all(); 

        return view('adm.dashboard', compact('animes'));
    }

    public function destroy($id)
    {
        $anime = Anime::findOrFail($id);
        $anime->delete();

        return redirect()->route('adm.dashboard')->with('success', 'Anime removido com sucesso!');
        
    }

    public function edit($id)
    {
        $anime = Anime::findOrFail($id);
        return view('adm.editar', compact('anime'));
    }

    public function update(Request $request, $id)
    {
        $anime = Anime::findOrFail($id);

        // Validação
        $request->validate([
            'titulo' => 'required|string|max:255',
            'resumo' => 'required|string',
            'imagem' => 'nullable|image|max:2048',  // Apenas se for imagem
            'data_lancamento' => 'required|date',
        ]);

        // Atualizar os dados do anime
        $anime->titulo = $request->titulo;
        $anime->resumo = $request->resumo;
        $anime->data_lancamento = $request->data_lancamento;

        // Verificar se uma nova imagem foi enviada
        if ($request->hasFile('imagem')) {
            // Exemplo de como salvar uma imagem
            $imagePath = $request->file('imagem')->store('public/animes');
            $anime->imagem_url = $imagePath;
        }

        $anime->save();

        return redirect()->route('anime.show', $anime->id)->with('success', 'Anime atualizado com sucesso!');
    }
}
