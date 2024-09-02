<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    public function create () {
        return view('auth.cadastro');
    }

    public function store (Request $request) {
       $user = User::create($request->all());
       return redirect()->route('login');
    }
}
