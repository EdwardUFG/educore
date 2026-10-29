<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CarreraController extends Controller
{
    /**
     * Mostrar todas las carreras registradas.
     */
    public function index()
    {
        $carreras = Carrera::orderBy('nombre')->paginate(10);

        return view('administracion.carreras.index', compact('carreras'));
    }

    /**
     * Mostrar el formulario para crear una carrera.
     */
    public function create()
    {
        return view('administracion.carreras.create');
    }

    /**
     * Guardar una nueva carrera.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => 'required|string|max:255|unique:carreras,codigo',
            'nombre' => 'required|string|max:255',
            'facultad' => 'required|string|max:255',
            'activa' => 'nullable|boolean',
        ]);

        $datos['activa'] = $request->boolean('activa');

        Carrera::create($datos);

        return redirect()
            ->route('administracion.carreras.index')
            ->with('success', 'Carrera registrada correctamente.');
    }

    /**
     * Mostrar el formulario para editar una carrera.
     */
    public function edit(Carrera $carrera)
    {
        return view('administracion.carreras.edit', compact('carrera'));
    }

    /**
     * Actualizar una carrera existente.
     */
    public function update(Request $request, Carrera $carrera)
    {
        $datos = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:255',
                Rule::unique('carreras', 'codigo')->ignore($carrera->id),
            ],
            'nombre' => 'required|string|max:255',
            'facultad' => 'required|string|max:255',
            'activa' => 'nullable|boolean',
        ]);

        $datos['activa'] = $request->boolean('activa');

        $carrera->update($datos);

        return redirect()
            ->route('administracion.carreras.index')
            ->with('success', 'Carrera actualizada correctamente.');
    }

    /**
     * Eliminar una carrera sin estudiantes ni cursos asociados.
     */
    public function destroy(Carrera $carrera)
    {
        if (
            $carrera->estudiantes()->exists() ||
            $carrera->cursos()->exists()
        ) {
            return redirect()
                ->route('administracion.carreras.index')
                ->with(
                    'error',
                    'No se puede eliminar una carrera que tenga estudiantes o cursos asociados.'
                );
        }

        $carrera->delete();

        return redirect()
            ->route('administracion.carreras.index')
            ->with('success', 'Carrera eliminada correctamente.');
    }
}
