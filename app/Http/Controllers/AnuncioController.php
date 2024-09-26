<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Support\Facades\Log;

class AnuncioController extends Controller
{
    public function index ()
    {
        return view('anuncios.index');
    }

    public function create ($id = null)
    {
        $anuncio =  $id ? anuncio::findOrFail($id) : null;
        Log::info($anuncio);
        return view('anuncios.create', compact('anuncio'));
    }
}