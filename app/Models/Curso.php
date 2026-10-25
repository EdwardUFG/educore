<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable = ['codigo', 'nombre', 'descripcion', 'carrera_id', 'ciclo_id', 'docente_id'];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'ciclo_id');
    }

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    public function estudiantes()
    {
        return $this->belongsToMany(User::class, 'curso_user', 'curso_id', 'user_id')->withTimestamps();
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class, 'curso_id');
    }
}