<?php

namespace App\Http\Controllers;

class PanelController extends Controller
{
    public function index()
    {
        $rol = auth()->user()->rol;

        if ($rol === 'estudiante') {
            return redirect()->route('mis-notas');
        }

        if (in_array($rol, ['admin', 'docente'], true)) {
            return view('evaluacion.paneles.dashboard');
        }

        abort(403);
    }
}
