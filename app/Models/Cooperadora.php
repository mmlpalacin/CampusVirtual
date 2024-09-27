<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooperadora extends Model
{
    use HasFactory;
    protected $table = 'cooperadora';

    protected $fillable = ['configuracion_id', 'user_id', 'pagado', 'monto_pendiente', 'estado', 'observacion'];

    public function configuracion()
    {
        return $this->belongsTo(Configuracion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comprobantes()
    {
        return $this->morphMany(imagen::class, 'imageable');
    }
}
