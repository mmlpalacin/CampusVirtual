<?php

use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Admin\MesaExamenController;
use App\Http\Controllers\Admin\CrearCursoController;
use App\Http\Controllers\Admin\CrearRolController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AnuncioController;
use Illuminate\Support\Facades\Route;
use App\Models\Configuracion;
use App\Models\Curso;

route::resource('/users', UsersController::class)->names('admin.users')->middleware('can:admin.users.create')->except('index');
Route::get('/users', [UsersController::class, 'index'])->name('admin.users.index')->middleware('can:admin.users.index');

route::resource('configuracion', ConfiguracionController::class)->names('admin.configuracion');

route::resource('mesas', MesaExamenController::class)->names('admin.mesas');

route::resource('/cursos', CrearCursoController::class)->names('admin.cursos');

route::resource('roles', CrearRolController::class)->names('admin.roles')->middleware('can:admin.roles.index');

route::resource('materias', MateriaController::class)->names('admin.materias');

Route::match(['get', 'post'],'/cursos/{curso}/horario', function ($cursoId) {
    $curso = Curso::findOrFail($cursoId); // Busca el curso por ID
    $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
    return view('horarios.index', ['curso' => $curso, 'configuracion' => $configuracion]);
})->name('horario')->middleware('can:admin.horario.edit');

route::get('anuncios', [AnuncioController::class, 'index'])->name('admin.anuncio.index')->middleware('can:admin.anuncio.index');
route::get('anuncios/anuncio/{id?}', [AnuncioController::class, 'create'])->name('admin.anuncio.create')->middleware('can:admin.anuncio.create');
route::delete('anuncios/{anuncio}', [AnuncioController::class, 'destroy'])->name('admin.anuncio.destroy')->middleware('can:admin.anuncio.destroy');
