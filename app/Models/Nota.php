<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    protected $fillable = ['boletin_id','materia_id','bimestre','notas'];

    public function boletin()
    {
        return $this->belongsTo(Boletin::class);
    }
    
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}
