<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth', 'UsuarioController@autenticar');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/usuarios'], function () {
    Route::get('/', 'UsuarioController@index');
    Route::get('/{usuario}', 'UsuarioController@detalhar');
    Route::post('/', 'UsuarioController@cadastrar');
    Route::put('/', 'UsuarioController@editar');
    Route::delete('/', 'UsuarioController@remover');
});
