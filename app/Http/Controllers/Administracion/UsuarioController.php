<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;

class UsuarioController extends Controller
{
    public function index(): View
    {
        $usuarios = User::query()
            ->with('carrera')
            ->orderBy('rol')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.usuarios.index', compact('usuarios'));
    }
}
