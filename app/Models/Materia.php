<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materias';

    protected $fillable = ['name', 'tipo'];

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function cursos()
    {
        return $this->hasManyThrough(Curso::class, Horario::class, 'materia_id', 'id', 'id', 'curso_id');
    }

    public function scopeMateriasPorCurso(Builder $query, $cursoId)
    {
        return $query->whereHas('horarios', function ($query) use ($cursoId) {
            $query->where('curso_id', $cursoId);
        })->orderBy('name');    
    }

    public function profesores()
    {
        return $this->hasManyThrough(User::class, Horario::class, 'materia_id', 'id', 'id', 'profesor_id');
    }
}
