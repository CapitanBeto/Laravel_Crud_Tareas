<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\apiCrudController;
use App\Http\Controllers\apiFotosController;
use App\Http\Controllers\apiAccesoController;
use App\Models\ListaTareas;
use App\Models\Fotos;
// Authenticated User Endpoint
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth.basic')->apiResource('tareas-fotos', ApiCrudController::class);


// API Resource Routes
Route::resource('tareas', apiCrudController::class);
Route::resource('tareas-fotos', apiFotosController::class);
Route::resource('tareas-login', apiAccesoController::class);

//Route::controller(CrudController::class)->group(function () {
  //  Route::get('v1/crud', 'index');
//});
