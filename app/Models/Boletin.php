<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boletin extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'curso_id', 'ciclo_lectivo'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public static function UltimoBoletin($userId)
    {
        $ultimoCicloLectivo = Configuracion::latest('id')->first();

        if ($ultimoCicloLectivo) {
            return Boletin::where('user_id', $userId)
                        ->where('ciclo_lectivo', $ultimoCicloLectivo->id)
                        ->first();
        }

        return null;
    }

    public function alumno()
    {
        return $this->belongsTo(User::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
