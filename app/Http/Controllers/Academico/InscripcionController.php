<?php

namespace App\Http\Controllers\Academico;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InscripcionController extends Controller
{
    /**
     * Mostrar cursos y estudiantes disponibles.
     */
    public function index()
    {
        $cursos = Curso::with(['carrera', 'ciclo', 'docente'])
            ->withCount('estudiantes')
            ->orderBy('nombre')
            ->get();

        $estudiantes = User::where('rol', 'estudiante')
            ->orderBy('name')
            ->get();

        $cursoSeleccionado = request()->query('curso');

        return view('academico.inscripciones.index', compact(
            'cursos',
            'estudiantes',
            'cursoSeleccionado'
        ));
    }

    /**
     * Inscribir un estudiante en un curso.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'curso_id' => [
                'required',
                'exists:cursos,id',
            ],
            'estudiante_id' => [
                'required',
                Rule::exists('users', 'id')->where(
                    fn ($query) => $query->where('rol', 'estudiante')
                ),
            ],
        ]);

        $curso = Curso::findOrFail($datos['curso_id']);

        // Evitar inscripciones duplicadas.
        $yaInscrito = $curso->estudiantes()
            ->where('users.id', $datos['estudiante_id'])
            ->exists();

        if ($yaInscrito) {
            return back()
                ->withErrors([
                    'estudiante_id' =>
                        'Este estudiante ya está inscrito en el curso.',
                ])
                ->withInput();
        }

        // Registrar la inscripción.
        $curso->estudiantes()->attach($datos['estudiante_id']);

        return redirect()
            ->route('academico.inscripciones.index', [
                'curso' => $curso->id,
            ])
            ->with('success', 'Estudiante inscrito correctamente.');
    }

    /**
     * Retirar un estudiante de un curso.
     */
    public function destroy(Curso $curso, User $estudiante)
    {
        // Comprobar que el usuario tenga rol de estudiante.
        if ($estudiante->rol !== 'estudiante') {
            abort(404);
        }

        // Verificar que esté inscrito en el curso.
        $inscrito = $curso->estudiantes()
            ->where('users.id', $estudiante->id)
            ->exists();

        if (! $inscrito) {
            return back()->withErrors([
                'estudiante' =>
                    'El estudiante no está inscrito en este curso.',
            ]);
        }

        // Eliminar la inscripción sin borrar al estudiante.
        $curso->estudiantes()->detach($estudiante->id);

        return redirect()
            ->route('academico.inscripciones.index', [
                'curso' => $curso->id,
            ])
            ->with('success', 'Estudiante retirado del curso correctamente.');
    }
}
