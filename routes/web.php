<?php

use App\Http\Controllers\HomeController;
use App\Models\Anuncio;
use App\Models\Cooperadora;
use App\Models\Imagen;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
require __DIR__ . '/admin.php';
require __DIR__ . '/alumno.php';
require __DIR__ . '/preceptor.php';
require __DIR__ . '/cooperadora.php';

Route::get('/', function () {
    $users = User::role('admin')->pluck('id');
    $anuncios = Anuncio::where('status', 2)->whereIn('user_id', $users)->latest('published')->paginate();
    $user = Auth::user();
    if ($user && $user->role('alumno')) {
        $cursoId = $user->inscripcion->pluck('curso_id')->first();
    
        $anunciosCurso = Anuncio::where('status', 2)
        ->where('curso_id', $cursoId)
        ->latest('published')
        ->get();
        $anuncios = $anuncios->merge($anunciosCurso)->sortByDesc('published');
    }
    return view('welcome', compact('anuncios'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});