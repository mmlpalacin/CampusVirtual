<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function profesores()
    {
        return $this->hasManyThrough(User::class, Horario::class, 'materia_id', 'id', 'id', 'profesor_id');
    }
}
