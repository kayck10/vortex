<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Plataforma extends Controller
{
    public function index () {
        $users = User::all();
        return view('index', compact('users'));
    }
    public function aulas () {
        $users = User::all();
        return view('aulas', compact('users'));
    }
    public function video1 () {
        $users = User::all();
        return view('videos.video1', compact('users'));
    }
    public function video2() {
        $users = User::all();
        return view('videos.video2', compact('users'));
    }
    public function video3 () {
        $users = User::all();
        return view('videos.video3', compact('users'));
    }
    public function video4 () {
        $users = User::all();
        return view('videos.video4', compact('users'));
    }
    public function video5 () {
        $users = User::all();
        return view('videos.video5', compact('users'));
    }
    public function video6 () {
        $users = User::all();
        return view('videos.video6', compact('users'));
    }
    public function robo () {
        $users = User::all();
        return view('robo', compact('users'));
    }
}
