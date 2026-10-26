<?php

namespace App\Http\Controllers\Academico;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Ciclo;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CursoController extends Controller
{
    /**
     * Mostrar todos los cursos.
     */
    public function index()
    {
        $cursos = Curso::with(['carrera', 'ciclo', 'docente'])
            ->orderBy('nombre')
            ->paginate(10);

        return view('academico.cursos.index', compact('cursos'));
    }

    /**
     * Formulario para crear un curso.
     */
    public function create()
    {
        $carreras = Carrera::where('activa', true)
            ->orderBy('nombre')
            ->get();

        $ciclos = Ciclo::where('activo', true)
            ->orderByDesc('fecha_inicio')
            ->get();

        $docentes = User::where('rol', 'docente')
            ->orderBy('name')
            ->get();

        return view('academico.cursos.create', compact(
            'carreras',
            'ciclos',
            'docentes'
        ));
    }

    /**
     * Guardar un nuevo curso.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:20',
                'unique:cursos,codigo',
            ],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'carrera_id' => [
                'required',
                'exists:carreras,id',
            ],
            'ciclo_id' => [
                'required',
                'exists:ciclos,id',
            ],
            'docente_id' => [
                'required',
                Rule::exists('users', 'id')
                    ->where(fn ($query) =>
                        $query->where('rol', 'docente')
                    ),
            ],
        ]);

        $curso = Curso::create($datos);

        return redirect()
            ->route('academico.cursos.show', $curso)
            ->with('success', 'Curso creado correctamente.');
    }

    /**
     * Mostrar los detalles de un curso.
     */
    public function show(Curso $curso)
    {
        $curso->load([
            'carrera',
            'ciclo',
            'docente',
            'estudiantes',
        ]);

        return view('academico.cursos.show', compact('curso'));
    }

    /**
     * Formulario para editar un curso.
     */
    public function edit(Curso $curso)
    {
        $carreras = Carrera::orderBy('nombre')->get();
        $ciclos = Ciclo::orderByDesc('fecha_inicio')->get();

        $docentes = User::where('rol', 'docente')
            ->orderBy('name')
            ->get();

        return view('academico.cursos.edit', compact(
            'curso',
            'carreras',
            'ciclos',
            'docentes'
        ));
    }

    /**
     * Actualizar un curso.
     */
    public function update(Request $request, Curso $curso)
    {
        $datos = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:20',
                Rule::unique('cursos', 'codigo')
                    ->ignore($curso->id),
            ],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'carrera_id' => ['required', 'exists:carreras,id'],
            'ciclo_id' => ['required', 'exists:ciclos,id'],
            'docente_id' => [
                'required',
                Rule::exists('users', 'id')
                    ->where(fn ($query) =>
                        $query->where('rol', 'docente')
                    ),
            ],
        ]);

        $curso->update($datos);

        return redirect()
            ->route('academico.cursos.index')
            ->with('success', 'Curso actualizado correctamente.');
    }

    /**
     * Eliminar un curso.
     */
    public function destroy(Curso $curso)
    {
        $curso->delete();

        return redirect()
            ->route('academico.cursos.index')
            ->with('success', 'Curso eliminado correctamente.');
    }
}
