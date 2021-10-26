<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\TareaAlumnoController;
use App\Http\Controllers\EvaluacionAlumnoController;
use App\Http\Controllers\AlumnoClasesController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('alumno',AlumnoController::class);
Route::post('alumno_index', [AlumnoController::class, 'index']);
Route::post('alumno_update', [AlumnoController::class, 'update']);
Route::post('alumno_delete', [AlumnoController::class, 'destroy']);

Route::resource('maestro',MaestroController::class);
Route::post('maestro_index', [MaestroController::class, 'index']);
Route::post('maestro_update', [MaestroController::class, 'update']);
Route::post('maestro_delete', [MaestroController::class, 'destroy']);
Route::get('maestro_asignaturas/{id}', [MaestroController::class, 'Asignaturas']);
Route::post('maestro_asig_index', [MaestroController::class, 'table_asignaturas']);
Route::post('maestro_asignadas_index', [MaestroController::class, 'asignaturas_establecidas']);
Route::post('select_asignatura', [MaestroController::class, 'seleccionar_asignatura']);
Route::post('quitar_asignatura', [MaestroController::class, 'quitar_asignatura']);

Route::get('create-roles', [MaestroController::class, 'create_roles']);

Route::resource('grupo',GrupoController::class);
Route::post('grupo_index', [GrupoController::class, 'index']);
Route::post('grupo_update', [GrupoController::class, 'update']);
Route::post('grupo_delete', [GrupoController::class, 'destroy']);

Route::resource('asignatura',AsignaturaController::class);
Route::post('asignatura_index', [AsignaturaController::class, 'index']);
Route::post('asignatura_update', [AsignaturaController::class, 'update']);
Route::post('asignatura_delete', [AsignaturaController::class, 'destroy']);

Route::resource('clase',ClaseController::class);
Route::post('clase_index', [ClaseController::class, 'index']);
Route::post('clase_update', [ClaseController::class, 'update']);
Route::post('clase_delete', [ClaseController::class, 'destroy']);
Route::get('clase-asignaturas/{id}', [ClaseController::class, 'clase_asignaturas']);
Route::post('clase_asignaturas_index', [ClaseController::class, 'index_class_sub']);
Route::post('add_asignaturas', [ClaseController::class, 'Agregar_asignaturas']);
Route::post('del_asignaturas', [ClaseController::class, 'Quitar_asignaturas']);
Route::get('clase-alumnos/{id}', [ClaseController::class, 'clase_alumnos']);

Route::post('alumnos_general_index', [ClaseController::class, 'alumnos_general']);
Route::post('alumnos_class_index', [ClaseController::class, 'alumnos_clase_asig_index']);

Route::post('add_alumno', [ClaseController::class, 'Add_alumnos']);
Route::post('del_alumno', [ClaseController::class, 'Del_alumnos']);

Route::get('perfil/{id}',[PerfilController::class, 'index']);
Route::post('perfil_update', [PerfilController::class, 'update']);


Route::get('Alumnos-clase/{id}',[AlumnoClasesController::class, 'index']);
Route::post('alumnos_clase',[AlumnoClasesController::class, 'index_alumnos_clase']);


Route::get('publicacion/{id}',[AnuncioController::class, 'index']);
Route::post('public_asig_index',[AnuncioController::class, 'index_publics_maestro']);
Route::get('publicacion/{id}/create',[AnuncioController::class, 'create']);
Route::get('publicacion/{id}/edit',[AnuncioController::class, 'edit']);

Route::post('guardar_publicacion',[AnuncioController::class, 'store']);
Route::post('update_publicacion',[AnuncioController::class, 'update']);
Route::post('public_delete', [AnuncioController::class, 'destroy']);

Route::get('archivo-publics/{id}',[AnuncioController::class, 'index_files_public']);
Route::get('coments/{id}',[AnuncioController::class, 'index_coments']);
Route::post('index_files', [AnuncioController::class, 'index_archivos']);
Route::post('guardar_archivos',[AnuncioController::class, 'Save_files']);
Route::post('file_delete', [AnuncioController::class, 'destroy_file']);

Route::prefix('evaluacion')->group(function () {
    Route::get('/{id}',[EvaluacionController::class, 'index']);
    Route::get('/{id}/create',[EvaluacionController::class, 'create']);
    Route::get('/{id}/edit',[EvaluacionController::class, 'edit']);
    Route::get('/{id}/alumnos',[EvaluacionController::class, 'Alumno_Evalucion']);
    Route::post('/alumno_eval_index',[EvaluacionController::class, 'Alumno_Evalucion_Index']);
});

Route::post('evaluacion_asig_index',[EvaluacionController::class, 'index_evaluacion']);

Route::post('guardar_evaluacion',[EvaluacionController::class, 'store']);
Route::post('update_evaluacion',[EvaluacionController::class, 'update']);
Route::post('evaluacion_delete', [EvaluacionController::class, 'destroy']);





