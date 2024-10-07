<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Support\Facades\Auth;

class AnuncioController extends Controller
{
    public function index ()
    {
        return view('anuncios.index');
    }

    public function create($id = null)
    {
        $anuncio = $id ? Anuncio::findOrFail($id) : null;

        if ($anuncio && Auth::user()->id != $anuncio->user_id) {
            abort(403, 'No tienes permiso para editar este anuncio.');
        }

        return view('anuncios.create', compact('anuncio'));
    }
    
    public function destroy (Anuncio $anuncio)
    {
        if ($anuncio && Auth::user()->id != $anuncio->user_id) {
            abort(403, 'No tienes permiso para editar este anuncio.');
        }
        $anuncio->delete();
        
        return redirect()->route('admin.anuncio.index')->with('info','El anuncio se elimino con exito');
    }
}