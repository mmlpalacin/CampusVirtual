<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;
    protected $fillable = ['partido', 'provincias_id'];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincias_id');
    }

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class);
    }
}
