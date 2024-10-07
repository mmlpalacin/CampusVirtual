<?php

use App\Http\Controllers\Preceptor\AsistenciaController;
use Illuminate\Support\Facades\Route;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;

Route::get('/mis-cursos', function () {
    $cursos = Auth::user()->cursos;
    return view('preceptor.lista-cursos', compact('cursos'));
})->name('prece.curso.index'); //modificar

route::resource('curso/{curso}/asistencia', AsistenciaController::class)->names('prece.asistencia');