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

Route::post('guardarEmpleado', 'ApiControllers@guardar');
Route::get('openModalEdit/{id}', 'ApiControllers@peticModalEdit');
Route::put('editEmpleado/{id}', 'ApiControllers@editarEmpleado');
Route::delete('eliminarEmpleado/{id}', 'ApiControllers@eliminarEmpleado');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
