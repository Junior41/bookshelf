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


Route::get('/', [App\Http\Controllers\InitController::class, 'index']);
Route::post('/cadastrarSocio', [App\Http\Controllers\InitController::class, 'cadastro']);

Route::group(['middleware' => 'auth'], function() {

    Route::get('/filtro', [App\Http\Controllers\HomeController::class, 'filtroNome']);

    Route::post('/filtro', [App\Http\Controllers\HomeController::class, 'filtroNome']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

    Route::resource('/fornecedor', App\Http\Controllers\FornecedorController::class);

    Route::get('/exemplar/reservar/{codigo}', [App\Http\Controllers\ExemplarController::class, 'show_reservar']);
    Route::put('/exemplar/reservar/{codigo}', [App\Http\Controllers\ExemplarController::class, 'reservar']);
    Route::get('/exemplar/entregar', [App\Http\Controllers\ExemplarController::class, 'show_entregar']);
    Route::put('/exemplar/entregar', [App\Http\Controllers\ExemplarController::class, 'entregar']);
    Route::resource('/exemplar', App\Http\Controllers\ExemplarController::class);

    Route::resource('/administrador', App\Http\Controllers\AdministradorController::class);

    Route::resource('/funcionario', App\Http\Controllers\FuncionarioController::class);

    Route::resource('/socio', App\Http\Controllers\SocioController::class);

    Route::resource('/livro', App\Http\Controllers\LivroController::class);

    Route::resource('/categoria', App\Http\Controllers\CategoriaController::class);
});