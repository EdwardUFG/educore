<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'asignaciones';

    protected $fillable = ['curso_id', 'titulo', 'descripcion', 'porcentaje', 'fecha_entrega'];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function notas()
    {
        return $this->hasMany(Nota::class, 'asignacion_id');
    }
}