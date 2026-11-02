@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl space-y-6">
        <header class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Materias</h1>
                <p class="mt-1 text-sm text-slate-600">Administra materias y sus docentes asignados.</p>
            </div>
            <a href="{{ route('academico.cursos.create') }}" class="rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">Crear materia</a>
        </header>

        @if (session('success'))
            <p role="status" class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</p>
        @endif

        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Materia</th>
                        <th class="px-5 py-3">Carrera</th>
                        <th class="px-5 py-3">Ciclo</th>
                        <th class="px-5 py-3">Docente asignado</th>
                        <th class="px-5 py-3"><span class="sr-only">Acciones</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($cursos as $curso)
                        <tr>
                            <td class="px-5 py-4">
                                <a href="{{ route('academico.cursos.show', $curso) }}" class="font-medium text-slate-900 hover:underline">{{ $curso->nombre }}</a>
                                <p class="mt-1 text-sm text-slate-500">{{ $curso->codigo }}</p>
                            </td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $curso->carrera->nombre }}</td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $curso->ciclo->nombre }}</td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $curso->docente->name }}</td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('academico.cursos.edit', $curso) }}" class="text-sm font-medium text-slate-700 hover:text-slate-950">Editar asignación</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-10 text-center text-sm text-slate-500">No hay materias registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $cursos->links() }}
    </div>
@endsection
