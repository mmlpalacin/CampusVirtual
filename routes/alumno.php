<?php

use App\Http\Controllers\Alumno\CertificadoController;
use App\Http\Controllers\Alumno\FormController;
use Illuminate\Support\Facades\Route;

Route::middleware(['can:alumno.datos.create'])->group(function () {
    Route::get('/alumno/formulario/1', [FormController::class, 'form1'])->name('alumno.datos.form1');
    Route::post('/alumno/formulario/1', [FormController::class, 'form1Store'])->name('alumno.datos.form1.store');
    
    Route::get('/alumno/formulario/2/{inscripcion}', [FormController::class, 'form2'])->name('alumno.datos.form2');
    Route::post('/alumno/formulario/2/{inscripcion}', [FormController::class, 'form2Store'])->name('alumno.datos.form2.store');

    Route::get('/alumno/formulario/3/{inscripcion}', [FormController::class, 'form3'])->name('alumno.datos.form3');
    Route::post('/alumno/formulario/3/{inscripcion}', [FormController::class, 'form3Store'])->name('alumno.datos.form3.store');

    Route::get('/alumno/formulario/4/{inscripcion}', [FormController::class, 'form4'])->name('alumno.datos.form4');
    Route::post('/alumno/formulario/4/{inscripcion}', [FormController::class, 'form4Store'])->name('alumno.datos.form4.store');

    Route::get('/alumno/formulario/5/{inscripcion}', [FormController::class, 'form5'])->name('alumno.datos.form5');
    Route::post('/alumno/formulario/5/{inscripcion}', [FormController::class, 'form5Store'])->name('alumno.datos.form5.store');
    
    Route::get('/alumno/formulario/tutores/{inscripcion}', [FormController::class, 'Padres'])->name('alumno.datos.padres');
    Route::post('/alumno/formulario/tutores', [FormController::class, 'PadresStore'])->name('alumno.datos.padres.store');
    
    Route::get('/provincias/{paisId}', [FormController::class, 'getProvincias']);
    Route::get('/partidos/{provinciaId}', [FormController::class, 'getPartidos']);
    Route::get('/ciudades/{partidoId}', [FormController::class, 'getCiudades']);
    
    route::post('/formulario/alumno/imprimir/{id}', [FormController::class, 'imprimir'])->name('alumno.imprimir');

    Route::get('/alumno', [FormController::class, 'index'])->name('alumno.datos.index');
});

Route::post('/generando-certificado/{user}', [CertificadoController::class, 'certificado'])->name('alumno.certificado');

Route::get('/boletin/{user}', [CertificadoController::class, 'boletin'])->name('alumno.boletin')->middleware('can:alumno.boletin');