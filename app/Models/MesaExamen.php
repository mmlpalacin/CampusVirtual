<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MesaExamen extends Model
{
    use HasFactory;
    protected $table = 'mesa_examen';

    protected $fillable = ['fecha', 'hora', 'anio', 'materia_id', 'user_id'];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
