<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Ciclo;
use Illuminate\Http\Request;

class CicloController extends Controller
{
    /**
     * Mostrar los ciclos académicos.
     */
    public function index()
    {
        $ciclos = Ciclo::orderByDesc('fecha_inicio')->paginate(10);

        return view('administracion.ciclos.index', compact('ciclos'));
    }

    /**
     * Mostrar el formulario de registro.
     */
    public function create()
    {
        return view('administracion.ciclos.create');
    }

    /**
     * Registrar un nuevo ciclo académico.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activo' => 'nullable|boolean',
        ]);

        $datos['activo'] = $request->boolean('activo');

        Ciclo::create($datos);

        return redirect()
            ->route('administracion.ciclos.index')
            ->with('success', 'Ciclo académico registrado correctamente.');
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(Ciclo $ciclo)
    {
        return view('administracion.ciclos.edit', compact('ciclo'));
    }

    /**
     * Actualizar un ciclo académico.
     */
    public function update(Request $request, Ciclo $ciclo)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activo' => 'nullable|boolean',
        ]);

        $datos['activo'] = $request->boolean('activo');

        $ciclo->update($datos);

        return redirect()
            ->route('administracion.ciclos.index')
            ->with('success', 'Ciclo académico actualizado correctamente.');
    }

    /**
     * Eliminar un ciclo si no tiene cursos asociados.
     */
    public function destroy(Ciclo $ciclo)
    {
        if ($ciclo->cursos()->exists()) {
            return redirect()
                ->route('administracion.ciclos.index')
                ->with(
                    'error',
                    'No se puede eliminar un ciclo que tenga cursos asociados.'
                );
        }

        $ciclo->delete();

        return redirect()
            ->route('administracion.ciclos.index')
            ->with('success', 'Ciclo académico eliminado correctamente.');
    }
}
