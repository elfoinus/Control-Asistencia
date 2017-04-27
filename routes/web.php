<?php

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

Route::get('/', function () {
    return view('login')->with('mensaje', 'Inicio');
});


#ruta que usa el login 
Route::post('/', 'LoginController@validarUsuario');

#rutas para llamar funciones por medio de load desde javascript
Route::any('/ProfesorControllerC','ProfesorController@calcularHorario');
Route::any('/ProfesorControllerI','ProfesorController@insertarRegistro');

Route::any('/ProfesorControllerM','ProfesorController@misAsignaturas');




