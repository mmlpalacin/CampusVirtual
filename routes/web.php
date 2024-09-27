<?php

use App\Models\Anuncio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
require __DIR__ . '/admin.php';
require __DIR__ . '/preceptor.php';

Route::get('/', function () {
    $users = User::role('admin')->pluck('id');
    $anuncios = Anuncio::where('status', 2)->whereIn('user_id', $users)->latest('published')->paginate();
    $user = Auth::user();
    if ($user->role('alumno')) {
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
    Route::get('/dashboard', function () {
        $user = auth::user();
        return view('dashboard', compact('user'));
    })->name('dashboard');
});
