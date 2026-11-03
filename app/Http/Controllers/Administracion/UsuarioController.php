<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;

class UsuarioController extends Controller
{
    public function adminIndex(): View
    {
        $usuarios = User::query()
            ->with('carrera')
            ->orderBy('rol')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Listar docentes y estudiantes con búsqueda y paginación.
     */
    public function index(Request $request)
    {
        $busqueda = trim($request->input('buscar', ''));
        $rol = $request->input('rol');

        $usuarios = User::with('carrera')
            ->whereIn('rol', ['docente', 'estudiante'])
            ->when(
                in_array($rol, ['docente', 'estudiante'], true),
                fn ($query) => $query->where('rol', $rol)
            )
            ->when($busqueda !== '', function ($query) use ($busqueda) {
                $query->where(function ($subquery) use ($busqueda) {
                    $subquery->where('name', 'like', "%{$busqueda}%")
                        ->orWhere('carnet', 'like', "%{$busqueda}%");
                });
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('administracion.usuarios.index', compact(
            'usuarios',
            'busqueda',
            'rol'
        ));
    }

    /**
     * Mostrar el formulario de registro.
     */
    public function create()
    {
        $carreras = Carrera::where('activa', true)
            ->orderBy('nombre')
            ->get();

        return view('administracion.usuarios.create', compact('carreras'));
    }

    /**
     * Registrar un docente o estudiante.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'rol' => 'required|in:docente,estudiante',
            'carrera_id' => [
                Rule::requiredIf(
                    $request->input('rol') === 'estudiante'
                ),
                'nullable',
                'integer',
                'exists:carreras,id',
            ],
            'password' => 'required|string|min:8',
        ]);

        // Los docentes no necesitan una carrera asignada.
        if ($datos['rol'] === 'docente') {
            $datos['carrera_id'] = null;
        }

        // El carnet se genera automáticamente.
        $datos['carnet'] = $this->generarCarnet($datos['rol']);

        User::create($datos);

        return redirect()
            ->route('administracion.usuarios.index', [
                'rol' => $datos['rol'],
            ])
            ->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(User $usuario)
    {
        abort_unless(
            in_array($usuario->rol, ['docente', 'estudiante'], true),
            404
        );

        $carreras = Carrera::where('activa', true)
            ->orderBy('nombre')
            ->get();

        return view('administracion.usuarios.edit', compact(
            'usuario',
            'carreras'
        ));
    }

    /**
     * Actualizar los datos de un usuario.
     */
    public function update(Request $request, User $usuario)
    {
        abort_unless(
            in_array($usuario->rol, ['docente', 'estudiante'], true),
            404
        );

        $reglasCarrera = $usuario->rol === 'estudiante'
            ? ['required', 'integer', 'exists:carreras,id']
            : ['nullable', 'integer', 'exists:carreras,id'];

        $datos = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($usuario->id),
            ],
            'carrera_id' => $reglasCarrera,
            'password' => 'nullable|string|min:8',
        ]);

        if ($usuario->rol === 'docente') {
            $datos['carrera_id'] = null;
        }

        // Si la contraseña se deja vacía, se conserva la anterior.
        if (empty($datos['password'])) {
            unset($datos['password']);
        }

        $usuario->update($datos);

        return redirect()
            ->route('administracion.usuarios.index', [
                'rol' => $usuario->rol,
            ])
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar un usuario si no tiene relaciones académicas.
     */
    public function destroy(User $usuario)
    {
        abort_unless(
            in_array($usuario->rol, ['docente', 'estudiante'], true),
            404
        );

        if (
            $usuario->cursosImpartidos()->exists() ||
            $usuario->cursosInscritos()->exists() ||
            $usuario->notas()->exists()
        ) {
            return back()->with(
                'error',
                'No se puede eliminar el usuario porque tiene registros académicos asociados.'
            );
        }

        $rol = $usuario->rol;

        $usuario->delete();

        return redirect()
            ->route('administracion.usuarios.index', ['rol' => $rol])
            ->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Generar un carnet único para el usuario.
     */
    private function generarCarnet(string $rol): string
    {
        if ($rol === 'docente') {
            $prefijo = 'DOC';
            $numero = 101;
        } else {
            // Ejemplo: PG26001.
            $prefijo = 'PG' . now()->format('y');
            $numero = 1;
        }

        do {
            $carnet = $prefijo . str_pad(
                (string) $numero,
                3,
                '0',
                STR_PAD_LEFT
            );

            $numero++;
        } while (User::where('carnet', $carnet)->exists());

        return $carnet;
    }
}
