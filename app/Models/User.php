<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'carnet',
        'rol',
        'carrera_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación: Un estudiante pertenece a una carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    // Relación: Cursos que imparte (cuando el usuario es docente)
    public function cursosImpartidos()
    {
        return $this->hasMany(Curso::class, 'docente_id');
    }

    // Relación: Cursos en los que está inscrito (cuando es estudiante)
    public function cursosInscritos()
    {
        return $this->belongsToMany(Curso::class, 'curso_user', 'user_id', 'curso_id')->withTimestamps();
    }

    // Relación: Notas obtenidas por el estudiante
    public function notas()
    {
        return $this->hasMany(Nota::class, 'estudiante_id');
    }
}