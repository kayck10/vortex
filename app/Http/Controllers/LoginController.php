<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Exibe a página de login
    public function login()
    {
        return view('auth.login');
    }

    // Lida com a autenticação do usuário
    public function authenticate(Request $request)
    {
        // Valida os dados de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Tenta autenticar o usuário
        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('index'); // Redireciona para a página principal em caso de sucesso
        } else {
            // Define uma mensagem de erro na sessão
            Session::flash('mensagem.falha', 'Email ou senha inválidos');
            return redirect()->back(); // Redireciona de volta ao formulário de login em caso de falha
        }
    }
}
