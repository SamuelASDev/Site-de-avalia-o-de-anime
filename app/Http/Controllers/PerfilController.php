<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    /**
     * Exibe a página de perfil do usuário autenticado.
     */
    public function index()
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Verifica se o usuário está autenticado
        if (!$user) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar o perfil.');
        }

        // Carrega os animes avaliados pelo usuário
        $animesAvaliados = $user->animes()->withPivot('NotaAnime', 'Opinião')->get();

        // Retorna a view de perfil com os dados do usuário e seus animes avaliados
        return view('perfil', compact('user', 'animesAvaliados'));
    }

    public function uploadImagem(Request $request)
    {
        $request->validate([
            'imagem_perfil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        try {
            // Verifica se o arquivo foi enviado
            if ($request->hasFile('imagem_perfil')) {
                // Salva a nova imagem no diretório
                $imagemPath = $request->file('imagem_perfil')->store('public/perfis');

                // Remove a imagem antiga, se houver
                if ($user->imagem_perfil) {
                    Storage::delete($user->imagem_perfil);
                }

                // Atualiza o caminho da nova imagem no banco de dados
                $user->update(['imagem_perfil' => $imagemPath]);

                return redirect()->route('perfil')->with('success', 'Imagem de perfil atualizada com sucesso!');
            } else {
                return redirect()->route('perfil')->with('error', 'Nenhuma imagem foi enviada.');
            }
        } catch (\Exception $e) {
            // Em caso de erro, retorna uma mensagem para o usuário
            return redirect()->route('perfil')->with('error', 'Ocorreu um erro ao atualizar a imagem de perfil. Tente novamente.');
        }
    }

}
