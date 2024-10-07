<?php

namespace App\Observers;

use App\Models\Anuncio;
use Illuminate\Support\Facades\Storage;

class AnuncioObserver
{
    public function deleting(Anuncio $anuncio): void
    {
        if ($anuncio->image){
            Storage::delete($anuncio->image->url);
        }
    }
}
