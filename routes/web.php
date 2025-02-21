<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\AccesoController;
use App\Http\Controllers\ProtegidaController;
use App\Http\Controllers\UtilesController;


Route::get('/', [TareasController::class, 'tareas_inicio'])->name('tareas_inicio');
Route::get('/tareas', [TareasController::class, 'tareas_mostrar'])->name('tareas_mostrar');


Route::get('/tareas/crear', [TareasController::class, 'tareas_crear'])->name('tareas_crear');
Route::post('/tareas/crear', [TareasController::class, 'tareas_crear_post'])->name('tareas_crear_post');

Route::get('/tareas/editar/{id}', [TareasController::class, 'tareas_editar'])->name('tareas_editar');
Route::post('/tareas/editar/{id}', [TareasController::class, 'tareas_editar_post'])->name('tareas_editar_post');

Route::get('/tareas/eliminar/{id}', [TareasController::class, 'tareas_eliminar'])->name('tareas_eliminar');

Route::get('/tareas/fotos/{id}', [TareasController::class, 'tareas_fotos'])->name('tareas_fotos');
Route::post('/tareas/fotos/{id}', [TareasController::class, 'tareas_fotos_post'])->name('tareas_fotos_post');

Route::get('/tareas/fotos/eliminar/{id}/{foto_id}', [TareasController::class, 'tareas_fotos_eliminar'])->name('tareas_fotos_eliminar');

Route::get('/tareas/paginacion', [TareasController::class, 'tareas_paginacion'])->name('tareas_paginacion');

Route::get('/acceso/login', [AccesoController::class, 'acceso_login'])->name('acceso_login');
Route::post('/acceso/login', [AccesoController::class, 'acceso_login_post'])->name('acceso_login_post');

Route::get('/acceso/registro', [AccesoController::class, 'acceso_registro'])->name('acceso_registro');
Route::post('/acceso/registro', [AccesoController::class, 'acceso_registro_post'])->name('acceso_registro_post');

Route::get('/protegida', [ProtegidaController::class, 'protegida_inicio'])->name('protegida_inicio');
Route::get('/protegida/otra', [ProtegidaController::class, 'protegida_otra'])->name('protegida_otra');
Route::get('/protegida/sin-acceso', [ProtegidaController::class, 'protegida_sin_acceso'])->name('protegida_sin_acceso');
Route::post('/protegida/editar/{id}', [ProtegidaController::class, 'protegida_editar_post'])->name('protegida_editar_post');
Route::get('/protegida/editar/{id}', [ProtegidaController::class, 'protegida_editar'])->name('protegida_editar');
Route::get('/protegida/admins', [ProtegidaController::class, 'protegida_admins'])->name('protegida_admins');


Route::get('/acceso/salir', [AccesoController::class, 'acceso_salir'])->name('acceso_salir');
Route::get('/protegida/eliminar/{id}', [ProtegidaController::class, 'protegida_eliminar'])->name('protegida_eliminar');
Route::get('/protegida/privilegios/{id}', [ProtegidaController::class, 'protegida_privilegios'])->name('protegida_privilegios');

Route::get('/utiles', [UtilesController::class, 'utiles_inicio'])->name('utiles_inicio');
Route::get('/utiles/pdf/{id}', [UtilesController::class, 'utiles_pdf'])->name('utiles_pdf');
Route::get('/utiles/excel', [UtilesController::class, 'utiles_excel'])->name('utiles_excel');

