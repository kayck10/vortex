<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    public function edit()
{
    // Recupera o usuário logado
    $user = Auth::user();

    // Retorna a view de edição com os dados do usuário logado
    return view('edit', compact('user'));
}

public function update(Request $request)
{
    // Validação dos dados do formulário
    $validatedData = $request->validate([
        'password' => [
            'required',
            'string',
            'min:8',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
            'confirmed',
        ],
    ], [
        'password.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
        'password.regex' => 'A nova senha deve conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.',
        'password.confirmed' => 'As senhas não correspondem.',
    ]);

    $user = Auth::user();

    $user->password = Hash::make($validatedData['password']);
    $user->save();

    return redirect()->route('login.edit')->with('success', 'Senha atualizada com sucesso!');
}

}
