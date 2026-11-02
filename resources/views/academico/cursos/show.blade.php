@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-4xl space-y-6">
        <header class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <p class="text-sm font-medium text-slate-500">{{ $curso->codigo }}</p>
                <h1 class="mt-1 text-2xl font-semibold text-slate-900">{{ $curso->nombre }}</h1>
            </div>
            <a href="{{ route('academico.cursos.edit', $curso) }}" class="rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">Editar materia</a>
        </header>

        @if (session('success'))
            <p role="status" class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</p>
        @endif

        <section class="grid grid-cols-1 gap-4 rounded-xl border border-slate-200 bg-white p-6 shadow-sm sm:grid-cols-2">
            <div><p class="text-xs font-semibold uppercase text-slate-500">Carrera</p><p class="mt-1 text-sm text-slate-900">{{ $curso->carrera->nombre }}</p></div>
            <div><p class="text-xs font-semibold uppercase text-slate-500">Ciclo</p><p class="mt-1 text-sm text-slate-900">{{ $curso->ciclo->nombre }}</p></div>
            <div><p class="text-xs font-semibold uppercase text-slate-500">Docente asignado</p><p class="mt-1 text-sm text-slate-900">{{ $curso->docente->name }}</p></div>
            <div><p class="text-xs font-semibold uppercase text-slate-500">Estudiantes</p><p class="mt-1 text-sm text-slate-900">{{ $curso->estudiantes->count() }}</p></div>
            @if ($curso->descripcion)
                <div class="sm:col-span-2"><p class="text-xs font-semibold uppercase text-slate-500">Descripción</p><p class="mt-1 text-sm text-slate-700">{{ $curso->descripcion }}</p></div>
            @endif
        </section>

        <form method="POST" action="{{ route('academico.cursos.destroy', $curso) }}" onsubmit="return confirm('¿Eliminar esta materia?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm font-medium text-rose-700 hover:text-rose-900">Eliminar materia</button>
        </form>
    </div>
@endsection
