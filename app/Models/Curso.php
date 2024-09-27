<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'turno_id', 'division_id', 'especialidad_id'];

    public function anuncio(){
        return $this->hasMany(Anuncio::class);
    }
    
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

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function materias()
    {
        return $this->hasManyThrough(Materia::class, Horario::class, 'curso_id', 'id', 'id', 'materia_id');
    }

    public function profesores()
    {
        return $this->hasManyThrough(User::class, Horario::class, 'curso_id', 'id', 'id', 'profesor_id');
    }
}
