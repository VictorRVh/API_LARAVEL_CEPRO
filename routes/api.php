<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EstudianteController;
use App\Http\Controllers\Api\DocenteController;
use App\Http\Controllers\Api\EspecialidadController;

use App\Http\Controllers\Api\UnidadDidacticaController;

use App\Http\Controllers\Api\IndicadorLogroController;

use App\Http\Controllers\Api\MatriculaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Router student
Route::get('/students',[EstudianteController::class,'index']);
Route::get('/students/{id}',[EstudianteController::class, 'findOneEstudent']);
Route::post('/students',[EstudianteController::class,'store']);
Route::put('/students/{id}',[EstudianteController::class, 'update']);
Route::patch('/students/{id}',[EstudianteController::class, 'updateParcial']);
Route::delete('/students/{id}',[EstudianteController::class, 'destroy']);

// Router teacher

Route::get('/teacher',[DocenteController::class,'index']);
Route::get('/teacher/{id}',[DocenteController::class, 'findOneDocente']);
Route::post('/teacher',[DocenteController::class,'store']);
Route::put('/teacher/{id}',[DocenteController::class, 'update']);
Route::patch('/teacher/{id}',[DocenteController::class, 'updateParcial']);
Route::delete('/teacher/{id}',[DocenteController::class, 'destroy']);

// Especialidad

Route::get('/especialidad',[EspecialidadController::class,'index']);
Route::get('/especialidad/{id}',[EspecialidadController::class, 'findOne']);
Route::post('/especialidad',[EspecialidadController::class,'store']);
Route::put('/especialidad/{id}',[EspecialidadController::class, 'update']);
Route::patch('/especialidad/{id}',[EspecialidadController::class, 'updateParcial']);
Route::delete('/especialidad/{id}',[EspecialidadController::class, 'destroy']);


// Unidad UnidadDidactica

Route::get('/unidad_didactica',[UnidadDidacticaController::class,'index']);
Route::get('/unidad_didactica/{id}',[UnidadDidacticaController::class, 'findOne']);
Route::post('/unidad_didactica',[UnidadDidacticaController::class,'store']);
Route::put('/unidad_didactica/{id}',[UnidadDidacticaController::class, 'update']);
Route::patch('/unidad_didactica/{id}',[UnidadDidacticaController::class, 'updateParcial']);
Route::delete('/unidad_didactica/{id}',[UnidadDidacticaController::class, 'destroy']);


// Indicardor Logro

Route::get('/indicador_logro',[IndicadorLogroController::class,'index']);
Route::get('/indicador_logro/{id}',[IndicadorLogroController::class, 'findOne']);
Route::post('/indicador_logro',[IndicadorLogroController::class,'store']);
Route::put('/indicador_logro/{id}',[IndicadorLogroController::class, 'update']);
Route::patch('/indicador_logro/{id}',[IndicadorLogroController::class, 'updateParcial']);
Route::delete('/indicador_logro/{id}',[IndicadorLogroController::class, 'destroy']);

// MAtricula

Route::get('/matricula',[MatriculaController::class,'index']);
Route::get('/matricula/{id}',[MatriculaController::class, 'findOne']);
Route::post('/matricula',[MatriculaController::class,'store']);
Route::put('/matricula/{id}',[MatriculaController::class, 'update']);
Route::patch('/matricula/{id}',[MatriculaController::class, 'updateParcial']);
Route::delete('/matricula/{id}',[MatriculaController::class, 'destroy']);
