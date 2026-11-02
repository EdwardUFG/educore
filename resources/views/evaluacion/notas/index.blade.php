@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl space-y-6">
        <header>
            <h1 class="text-2xl font-semibold text-slate-900">Notas de todos los estudiantes</h1>
            <p class="mt-1 text-sm text-slate-600">Calificaciones registradas por materia y evaluación.</p>
        </header>

        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr><th class="px-5 py-3">Estudiante</th><th class="px-5 py-3">Materia</th><th class="px-5 py-3">Evaluación</th><th class="px-5 py-3">Nota</th></tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($notas as $nota)
                        <tr>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $nota->estudiante->name }}</td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $nota->asignacion->curso->nombre }}</td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $nota->asignacion->titulo }}</td>
                            <td class="px-5 py-4 text-sm font-semibold tabular-nums text-slate-900">{{ number_format($nota->valor, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-5 py-10 text-center text-sm text-slate-500">No hay calificaciones registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $notas->links() }}
    </div>
@endsection
