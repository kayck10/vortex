<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {

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


    public function authenticate(Request $request)
    {
        $request->validate([
            "email" => 'required',
            "password" => 'required',
            'remember' => 'nullable',
        ]);
        try {
            $auth = Auth::attempt(["email" => $request->input('email'), "password" => $request->input('password')], $request->input('remember'));

            if (!$auth) {
                throw new Exception('LOGIN_FAILED');
            }

            return view('index');
        } catch (Exception $error) {
            return response()->json(
                ['message' => 'Email ou senha inválidos'],
                400,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
    }


}
