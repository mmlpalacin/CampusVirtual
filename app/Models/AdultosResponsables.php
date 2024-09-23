<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdultosResponsables extends Model
{
    use HasFactory;
    protected $table = 'Adultos_responsables';

    protected $fillable = ['inscripcion_id'];

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }
}
