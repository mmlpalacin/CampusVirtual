<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;
    protected $fillable = ['provincia', 'paises_id'];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'paises_id');
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
}
