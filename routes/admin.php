<?php
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Admin\CrearCursoController;
use App\Http\Controllers\Admin\UsersController;
use App\Livewire\Configuracion;
use App\Models\Curso;
use Illuminate\Support\Facades\Route;

route::resource('/users', UsersController::class)->names('admin.users')->middleware('can:admin.users.create')->except('index');
Route::get('/users', [UsersController::class, 'index'])->name('admin.users.index')->middleware('can:admin.users.index');

route::resource('configuracion', ConfiguracionController::class)->names('admin.configuracion');

route::resource('/cursos', CrearCursoController::class)->names('admin.cursos');

Route::match(['get', 'post'],'/cursos/{curso}/horario', function ($cursoId) {
    $curso = Curso::findOrFail($cursoId); // Busca el curso por ID
    $configuracion = Configuracion::orderBy('ciclo_lectivo', 'desc')->first();
    return view('horarios.index', ['curso' => $curso, 'configuracion' => $configuracion]);
})->name('horario')->middleware('can:admin.horario.edit');