<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\SupervisionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('alumnos', AlumnoController::class);
Route::get('/alumnos/{id}/proyectos',[AlumnoController::class, 'getProyectos']);
Route::resource('profesores', ProfesorController::class);
Route::resource('proyectos', ProyectoController::class);
Route::get('/proyectos/{id}/calificacion-final',[ProyectoController::class, 'getCalificacionFinal']);
Route::get('/proyectos/{id}/evaluaciones',[ProyectoController::class, 'getEvaluaciones']);
Route::resource('especialidades', EspecialidadController::class);
Route::get('/especialidades/{id}/proyectos',[EspecialidadController::class, 'getProyectos']);
Route::get('/especialidades/{id}/alumnos',[EspecialidadController::class, 'getAlumnos']);
Route::resource('supervisiones', SupervisionController::class);