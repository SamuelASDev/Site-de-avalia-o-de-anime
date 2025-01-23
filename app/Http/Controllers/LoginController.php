<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Para autenticação
use App\Models\User; // Importar o modelo User

class LoginController extends Controller
{
    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Processa o login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home')->with('aviso', 'Logado com sucesso');
        }
    
        // Verifica se o email existe para diferenciar erro de senha
        $emailExists = User::where('email', $request->email)->exists();
        if ($emailExists) {
            return redirect()->route('login')->with('aviso', 'Senha incorreta');
        }
    
        return redirect()->route('login')->with('aviso', 'Email não encontrado na base de dados');
    }
    
}
