<?php

namespace App\Http\Controllers\Academico;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InscripcionController extends Controller
{
    public function index(Request $request): View
    {
        $usuario = $request->user();

        if ($usuario->rol === 'admin') {
            $cursos = Curso::query()
                ->with(['carrera', 'ciclo', 'docente', 'estudiantes'])
                ->withCount('estudiantes')
                ->orderBy('nombre')
                ->get();

            $estudiantes = User::query()
                ->where('rol', 'estudiante')
                ->orderBy('name')
                ->get();

            return view('academico.inscripciones.index', compact('cursos', 'estudiantes'));
        }

        $cursos = Curso::query()
            ->whereDoesntHave('estudiantes', fn ($query) => $query->whereKey($usuario->id))
            ->with(['carrera', 'ciclo', 'docente'])
            ->orderBy('nombre')
            ->get();

        return view('academico.inscripciones.index', compact('cursos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $usuario = $request->user();
        $rules = [
            'curso_id' => ['required', 'integer', 'exists:cursos,id'],
        ];

        if ($usuario->rol === 'admin') {
            $rules['estudiante_id'] = [
                'required',
                'integer',
                Rule::exists('users', 'id')->where(
                    fn ($query) => $query->where('rol', 'estudiante')
                ),
            ];
        }

        $datos = $request->validate($rules);
        $estudiante = $usuario->rol === 'admin'
            ? User::query()->where('rol', 'estudiante')->findOrFail($datos['estudiante_id'])
            : $usuario;
        $curso = Curso::query()->findOrFail($datos['curso_id']);

        $curso->estudiantes()->syncWithoutDetaching([$estudiante->id]);

        return redirect()
            ->route('academico.inscripciones.index')
            ->with('success', 'Inscripción registrada correctamente.');
    }

    public function destroy(Curso $curso, User $estudiante): RedirectResponse
    {
        abort_unless($estudiante->rol === 'estudiante', 404);

        $curso->estudiantes()->detach($estudiante->id);

        return redirect()
            ->route('academico.inscripciones.index')
            ->with('success', 'Inscripción retirada correctamente.');
    }
}
