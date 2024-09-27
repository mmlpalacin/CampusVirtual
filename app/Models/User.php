<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'estado',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'user_id');
    }

    public function anuncio(){
        return $this->hasMany(Anuncio::class);
    }

    public function inscripcion(){
        return $this->hasOne(Inscripcion::class);
    }

    public function scopeAlumnosPorCurso(Builder $query, $cursoId)
    {
        return $query->whereHas('inscripcion', function ($query) use ($cursoId) {
            $query->where('curso_id', $cursoId);
        })->orderBy('lastname');
    }
    
    public function scopeProfesoresPorCurso(Builder $query, $cursoId, $materiaId = null)
    {
        return $query->whereHas('horarios', function ($query) use ($cursoId) {
            $query->where('curso_id', $cursoId);
            if(isset($materiaId)){
                $query->where('materia_id', $materiaId);
            }
        })->whereHas('roles', function ($query) {
            $query->where('name', 'profesor');
        })->orderBy('lastname');    
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'profesor_id');
    }

    public function cursos()
    {
        return $this->hasManyThrough(Curso::class, Horario::class, 'profesor_id', 'id', 'id', 'curso_id');
    }

    public function materias()
    {
        return $this->hasManyThrough(Materia::class, Horario::class, 'profesor_id', 'id', 'id', 'materia_id');
    }
}
