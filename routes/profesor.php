<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Configuracion;
use App\Models\Horario;
use App\Models\Curso;
use App\Models\Materia;

route::match(['get', 'post'], 'curso/{curso}/notas', function ($cursoId) {
    $curso = Curso::findOrFail($cursoId);
    $horas = Horario::where('profesor_id', Auth::user()->id)->where('curso_id', $cursoId)->get();
    $materias = Materia::whereIn('id', $horas->pluck('materia_id'))->get();

    $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
    return view('profesor.notas', ['curso' => $curso, 'configuracion' => $configuracion, 'materias' => $materias]);
})->name('profe.notas.edit')/*->middleware('can:profe.notas.edit')*/;