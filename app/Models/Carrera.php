<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = 'carreras';

    protected $fillable = ['codigo', 'nombre', 'facultad', 'activa'];

    public function estudiantes()
    {
        return $this->hasMany(User::class, 'carrera_id');
    }

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'carrera_id');
    }
}