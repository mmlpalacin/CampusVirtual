<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencia';

    protected $fillable = ['user_id', 'date', 'estado', 'turno'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
