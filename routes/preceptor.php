<?php

use App\Http\Controllers\Preceptor\AsistenciaController;
use App\Models\Curso;
use Illuminate\Support\Facades\Route;

Route::get('/mis-cursos', function () {
    $cursos = Curso::all();
    return view('preceptor.lista-cursos', compact('cursos'));
})->name('prece.curso.index'); //modificar

route::resource('curso/{curso}/asistencia', AsistenciaController::class)->names('prece.asistencia');