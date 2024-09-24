<?php

use App\Models\Anuncio;
use App\Models\User;
use Illuminate\Support\Facades\Route;
require __DIR__ . '/admin.php';

Route::get('/', function () {
    $users = User::role('admin')->pluck('id');
    $anuncios = Anuncio::where('status', 2)->whereIn('user_id', $users)->latest('published')->paginate();

    /*if (auth::user()) {
        $user = auth::user();
        $cursosIds = $user->Asignacion->pluck('curso_id')->toArray();
    
        $anunciosCurso = Anuncio::where('status', 2)
        ->whereIn('curso_id', $cursosIds)
        ->latest('published_at')
        ->get();
        $anuncios = $anuncios->merge($anunciosCurso)->sortByDesc('published_at');
    }*/
    return view('welcome', compact('anuncios'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
