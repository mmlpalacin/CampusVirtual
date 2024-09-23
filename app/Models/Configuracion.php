<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;
    protected $table = 'configuracion';

    protected $fillable = ['name', 'direccion', 'telefono', 'ciclo_lectivo', 'grados', 'cooperadora', 'hora_inicio', 'hora_fin', 'tipo_evaluacion', 'jornadas'];
}
