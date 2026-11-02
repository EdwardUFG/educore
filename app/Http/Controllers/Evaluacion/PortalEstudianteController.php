<?php

namespace App\Http\Controllers\Evaluacion;

use App\Http\Controllers\Controller;
use App\Models\Curso;

class PortalEstudianteController extends Controller
{
    public function index()
    {
        $usuario = auth()->user();
        $cursos = Curso::query()
            ->whereIn('id', $usuario->cursosInscritos()->select('cursos.id'))
            ->with([
                'asignaciones.notas' => fn ($query) => $query->where('estudiante_id', auth()->id()),
            ])
            ->get();

        foreach ($cursos as $curso) {
            $promedio = 0;

            foreach ($curso->asignaciones as $asignacion) {
                foreach ($asignacion->notas as $nota) {
                    $promedio += $nota->valor * ($asignacion->porcentaje / 100);
                }
            }

            $curso->promedio_acumulado = round($promedio, 2);
        }

        return view('evaluacion.estudiante.boleta', compact('cursos'));
    }
}
