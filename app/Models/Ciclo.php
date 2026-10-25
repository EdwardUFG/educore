<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    protected $table = 'ciclos';

    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin', 'activo'];

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'ciclo_id');
    }
}