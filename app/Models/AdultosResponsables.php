<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdultosResponsables extends Model
{
    use HasFactory;
    protected $table = 'adultos_responsables';

    protected $guarded = ['id'];

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class);
    }
}
