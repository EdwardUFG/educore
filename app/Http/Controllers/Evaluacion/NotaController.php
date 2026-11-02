<?php

namespace App\Http\Controllers\Evaluacion;

use App\Http\Controllers\Controller;
use App\Models\Nota;
use Illuminate\Contracts\View\View;

class NotaController extends Controller
{
    public function index(): View
    {
        $notas = Nota::query()
            ->with(['estudiante', 'asignacion.curso'])
            ->latest()
            ->paginate(20);

        return view('evaluacion.notas.index', compact('notas'));
    }
}
