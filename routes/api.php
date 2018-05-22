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


Route::get('/hola', function () {
    return "hello";
});

Route::get('create/{name}/{id}', [
  'uses' => 'playerController@create',
  'as' => 'create_phat'
]);

Route::post('almacenar', [
  'uses' => 'playerController@almacenarSopa',
  'as' => 'almacenar_phat'
]);

Route::get('cargar/{id}', [
  'uses' => 'playerController@cargarJuego',
  'as' => 'cargar_phat'
]);

