<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    protected $fillable = ['ciudad', 'partidos_id'];

    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partidos_id');
    }
}
