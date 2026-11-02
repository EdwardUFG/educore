<?php

namespace App\Http\Controllers\Evaluacion;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class PortalEstudianteController extends Controller
{
    public function index(): View
    {
        $usuario = auth()->user();

        $cursos = $usuario->cursosInscritos()
            ->with([
                'asignaciones.notas' => fn ($query) => $query->where('estudiante_id', auth()->id()),
            ])
            ->orderBy('nombre')
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

        return view('evaluacion.estudiante.boleta', [
            'cursos' => $cursos,
            'tieneCursosInscritos' => $cursos->isNotEmpty(),
        ]);
    }
}
