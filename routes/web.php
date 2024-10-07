<?php

use App\Http\Controllers\Admin\MesaExamenController;
use App\Http\Controllers\HomeController;
use App\Models\Anuncio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    require __DIR__ . '/admin.php';
    require __DIR__ . '/alumno.php';
    require __DIR__ . '/profesor.php';
    require __DIR__ . '/preceptor.php';
    require __DIR__ . '/cooperadora.php';
});
route::get('mesas', [MesaExamenController::class, 'index'])->name('admin.mesas.index');

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});