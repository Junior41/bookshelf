<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/filtro', [App\Http\Controllers\HomeController::class, 'filtroNome']);
Route::post('/filtro', [App\Http\Controllers\HomeController::class, 'filtroNome']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('/funcionario', App\Http\Controllers\FuncionarioController::class);

Route::resource('/livro', App\Http\Controllers\LivroController::class);

Route::resource('/categoria', App\Http\Controllers\CategoriaController::class);
