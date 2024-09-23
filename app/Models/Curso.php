<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'turno_id', 'division_id', 'especialidad_id'];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }
}
