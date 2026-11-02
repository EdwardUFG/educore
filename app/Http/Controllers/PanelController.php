<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Contracts\View\View;

class PanelController extends Controller
{
    public function index(): View
    {
        $usuario = auth()->user();

        if ($usuario->rol === 'estudiante') {
            $cursosInscritos = $usuario->cursosInscritos()
                ->with(['carrera', 'ciclo', 'docente'])
                ->orderBy('nombre')
                ->get();

            $cursosDisponibles = Curso::query()
                ->whereDoesntHave('estudiantes', fn ($query) => $query->whereKey($usuario->id))
                ->with(['carrera', 'ciclo', 'docente'])
                ->orderBy('nombre')
                ->get();

            return view('evaluacion.paneles.dashboard', compact('cursosInscritos', 'cursosDisponibles'));
        }

        if ($usuario->rol === 'docente') {
            $cursos = Curso::query()
                ->where('docente_id', $usuario->id)
                ->with(['carrera', 'ciclo'])
                ->orderBy('nombre')
                ->get();

            return view('evaluacion.paneles.dashboard', compact('cursos'));
        }

        if ($usuario->rol === 'admin') {
            return view('evaluacion.paneles.dashboard');
        }

        abort(403);
    }
}
