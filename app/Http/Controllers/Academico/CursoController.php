<?php

namespace App\Http\Controllers\Academico;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Ciclo;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CursoController extends Controller
{
    public function index(): View
    {
        $cursos = Curso::query()
            ->with(['carrera', 'ciclo', 'docente'])
            ->orderBy('nombre')
            ->paginate(10);

        return view('academico.cursos.index', compact('cursos'));
    }

    public function create(): View
    {
        return view('academico.cursos.create', $this->formOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $curso = Curso::query()->create($this->validatedData($request));

        return redirect()
            ->route('academico.cursos.show', $curso)
            ->with('success', 'Materia creada correctamente.');
    }

    public function show(Curso $curso): View
    {
        $curso->load(['carrera', 'ciclo', 'docente', 'estudiantes']);

        return view('academico.cursos.show', compact('curso'));
    }

    public function edit(Curso $curso): View
    {
        return view('academico.cursos.edit', [
            ...$this->formOptions(),
            'curso' => $curso,
        ]);
    }

    public function update(Request $request, Curso $curso): RedirectResponse
    {
        $curso->update($this->validatedData($request, $curso));

        return redirect()
            ->route('academico.cursos.index')
            ->with('success', 'Materia actualizada correctamente.');
    }

    public function destroy(Curso $curso): RedirectResponse
    {
        $curso->delete();

        return redirect()
            ->route('academico.cursos.index')
            ->with('success', 'Materia eliminada correctamente.');
    }

    /**
     * @return array{carreras: Collection, ciclos: Collection, docentes: Collection}
     */
    private function formOptions(): array
    {
        return [
            'carreras' => Carrera::query()->where('activa', true)->orderBy('nombre')->get(),
            'ciclos' => Ciclo::query()->where('activo', true)->orderByDesc('fecha_inicio')->get(),
            'docentes' => User::query()->where('rol', 'docente')->orderBy('name')->get(),
        ];
    }

    /**
     * @return array{codigo: string, nombre: string, descripcion: ?string, carrera_id: int, ciclo_id: int, docente_id: int}
     */
    private function validatedData(Request $request, ?Curso $curso = null): array
    {
        return $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:20',
                Rule::unique('cursos', 'codigo')->ignore($curso?->id),
            ],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'carrera_id' => ['required', 'integer', 'exists:carreras,id'],
            'ciclo_id' => ['required', 'integer', 'exists:ciclos,id'],
            'docente_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->where(
                    fn ($query) => $query->where('rol', 'docente')
                ),
            ],
        ]);
    }
}
