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

Route::any('/subirDatos', 'AdministradorController@subirDatos');


#rutas para llamar funciones por medio de load desde javascript
Route::any('/ProfesorControllerC','ProfesorController@calcularHorario');
Route::any('/ProfesorControllerI','ProfesorController@insertarRegistro');

Route::any('/ProfesorControllerM','ProfesorController@misAsignaturas');

Route::any('proceso/registrarUsuario', 'AdministradorController@registrarUsuario');

Route::any('/ProfesorControllerS','ProfesorController@semanaActual'); 
Route::any('/ProfesorControllerD','ProfesorController@tablasDeuda');
Route::any('/ProfesorControllerDe','ProfesorController@id_horarios_deuda');
Route::any('/cargarAsignaturas','ProfesorController@asignaturas');

Route::any('/listarUsuarios','AdministradorController@ListarUsuarios');
Route::any('/listarAsignaturas','AdministradorController@ListarAsignaturas');
Route::any('/listarProfesoresHoy','AdministradorController@ListarProfesoresHoy');
Route::any('/listarProfesoresHoysinAsistir','AdministradorController@ListarProfesoresHoySinAsistencia');

Route::any('/listarMonitoresHoy','AdministradorController@ListarMonitoresHoy');
Route::any('/listarMonitoresHoySinAsistir','AdministradorController@ListarMonitoresHoySinAsistencia');

Route::any('proceso1/cambiarClaveAdmin','AdministradorController@cambiarClave');

Route::any('/getPasswordUsuario','AdministradorController@getPasswordUsuario');
Route::any('proceso/crearHorario','AdministradorController@crearHorario');


Route::any('proceso/cambiarClaveUsuarios','AdministradorController@CambiarClaveUsuarios');
Route::get('proceso/generarReporte','AdministradorController@generarReporte');
Route::get('proceso/registrarReporte','ProfesorController@registrarReporte');

Route::any('/listarAsigParaReporte','ProfesorController@listarAsigParaReporte');
Route::any('proceso/crearTema','ProfesorController@crearTema');

Route::any('/listarAsignaturasUsuario','ProfesorController@ListarAsignaturasUsuario');

Route::any('proceso/cambiarClaveProfesor','ProfesorController@cambiarClave');












