<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function anuncio(){
        return $this->hasMany(Anuncio::class);
    }
    
    public function preceptor1()
    {
        return $this->belongsTo(User::class, 'preceptor_id');
    }

    public function preceptor2()
    {
        return $this->belongsTo(User::class, 'preceptor_id_2');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
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

    public function boletines()
    {
        return $this->hasMany(Boletin::class);
    }
    
    public function profesores()
    {
        return $this->hasManyThrough(User::class, Horario::class, 'curso_id', 'id', 'id', 'profesor_id');
    }
}
