<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Plataforma;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/cadastro', [CadastroController::class, 'create'])->name('cadastro.create');
Route::post('/cadastro/store', [CadastroController::class, 'store'])->name('cadastro.store');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('login/auth', [LoginController::class, 'authenticate'])->name('login.auth');
Route::get('login/edit', [LoginController::class, 'edit'])->name('login.edit');
Route::put('login/put', [LoginController::class, 'update'])->name('login.put');



Route::get('plataforma', [Plataforma::class, 'index'])->name('index');
Route::get('aulas', [Plataforma::class, 'aulas'])->name('aulas');
Route::get('video1', [Plataforma::class, 'video1'])->name('video1');
Route::get('video2', [Plataforma::class, 'video2'])->name('video.deposito');
Route::get('video3', [Plataforma::class, 'video3'])->name('video3');
Route::get('video4', [Plataforma::class, 'video4'])->name('video4');
Route::get('video5', [Plataforma::class, 'video5'])->name('video5');
Route::get('video6', [Plataforma::class, 'video6'])->name('video6');
Route::get('robo', [Plataforma::class, 'robo'])->name('robo');







