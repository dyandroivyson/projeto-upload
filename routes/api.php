<?php

use Illuminate\Http\Request;

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

Route::post('login', 'Auth\LoginController@loginApi');
Route::post('logout', 'Auth\LoginController@logoutApi');

Route::group(['middleware' => 'auth:api'], function() {
    // Grupo
    Route::post('grupo', 'GrupoController@cadastrar');
    Route::get('grupo', 'GrupoController@listar');

    // User
    Route::post('user', 'UserController@cadastrar');
    Route::get('user', 'UserController@listar');

    // Arquivo
    Route::post('arquivo', 'ArquivoController@cadastrar');
    Route::get('arquivo', 'ArquivoController@listar');
    Route::get('arquivo/{arquivo_id}', 'ArquivoController@ver');
    Route::get('arquivo/download/{arquivo_file_id}', 'ArquivoController@baixar');
});
