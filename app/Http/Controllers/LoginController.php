<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login() {
        return view('auth.login');
       }

       public function auth(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return to_route('index');
        } else {
            Session::flash('mensagem.falha', 'Email ou senha inválidos');
            return redirect()->back();
        }

       }
}
