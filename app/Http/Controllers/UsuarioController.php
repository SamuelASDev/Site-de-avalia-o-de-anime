<?php

namespace App\Http\Controllers;

use App\Models\User; // Adiciona o modelo User
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // Exibe o formulário de edição do usuário
    public function edit($id)
    {
        // Encontra o usuário pelo ID
        $usuario = User::findOrFail($id);

        // Retorna a view de edição com o usuário
        return view('adm.UsuarioEdit', compact('usuario'));
    }

    // Atualiza as informações do usuário
    public function update(Request $request, $id)
    {
        // Valida os dados do formulário
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id, // Verifica o email único, mas ignora o próprio usuário
            'nivel' => 'required|string|max:255',
            // Pode adicionar validação para a senha se necessário
        ]);

        // Encontra o usuário pelo ID
        $usuario = User::findOrFail($id);

        // Atualiza os dados do usuário
        $usuario->update($validated);

        // Redireciona para o dashboard com uma mensagem de sucesso
        return redirect()->route('adm.dashboard')->with('success', 'Usuário atualizado com sucesso!');
    }

    // Remove o usuário do banco de dados
    public function destroy($id)
    {
        // Encontra o usuário pelo ID
        $usuario = User::findOrFail($id);

        // Deleta o usuário
        $usuario->delete();

        // Redireciona para o dashboard com uma mensagem de sucesso
        return redirect()->route('adm.dashboard')->with('success', 'Usuário removido com sucesso!');
    }
}
