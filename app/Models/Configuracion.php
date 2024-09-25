<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;
    protected $table = 'configuracion';

    protected $fillable = ['name', 'direccion', 'telefono', 'ciclo_lectivo', 'hora_inicio', 'hora_fin', 'tipo_evaluacion','grados', 'cooperadora', 'jornadas', 'dias'];
    protected $casts = ['grados' => 'array', 'cooperadora' => 'array', 'jornadas' => 'array', 'dias'  => 'array'];
    
    public function getGradosDesglosadosAttribute()
    {
        return array_merge(
            $this->grados['ciclo_basico'] ?? [],
            $this->grados['ciclo_superior'] ?? []
        );
    }
}
