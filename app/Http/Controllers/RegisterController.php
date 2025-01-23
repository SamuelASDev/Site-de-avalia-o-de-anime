<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Importe o modelo User para salvar os dados
use Illuminate\Support\Facades\Hash; // Para criptografar a senha

class RegisterController extends Controller
{
    // Exibe o formulário de registro
    public function showRegisterForm()
    {
        return view('register'); // View de registro (register.blade.php)
    }

    // Processa o cadastro
    public function register(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cria o novo usuário e salva no banco de dados
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Criptografa a senha
        ]);

        // Redireciona para uma página (ex: login ou dashboard) com uma mensagem de sucesso
        return redirect('/')->with('success', 'Cadastro realizado com sucesso! Faça login para continuar.');
    }
}
