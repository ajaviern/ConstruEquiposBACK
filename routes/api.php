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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login','UserController@login');

Route::resource('user', 'UserController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('equipo', 'EquipoController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('categoriaequipo', 'CategoriaEquipoController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('producto', 'ProductoController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('peticionesinternas', 'PeticionesInternasController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

Route::resource('ingresos', 'IngresosController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);


//Alquileres
Route::post('RegistrarAlquiler', 'AlquilerController@store');
Route::post('DetallesIngresos', 'DetallesIngresosController@store');
Route::get('EquiposmasAlquilados', 'EquipoController@EquiposmasAlquilados');
Route::get('AlquileresSeisMesesAntes', 'EquipoController@AlquileresSeisMesesAntes');
Route::get('AlquilerporPersonas', 'UserController@AlquilerporPersonas');
Route::get('EquiposmasAlquiladosPorMes', 'EquipoController@EquiposmasAlquiladosPorMes');
Route::get('GetAllAlquileres/{id}', 'AlquilerController@show');
Route::get('GetAllAlquileres', 'AlquilerController@index');
Route::put('Facturar/{id}', 'AlquilerController@update');
