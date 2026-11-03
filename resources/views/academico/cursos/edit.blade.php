@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-3xl space-y-6">
        <header>
            <h1 class="text-2xl font-semibold text-slate-900">Editar materia</h1>
            <p class="mt-1 text-sm text-slate-600">{{ $curso->nombre }}</p>
        </header>

        <form method="POST" action="{{ route('academico.cursos.update', $curso) }}" class="space-y-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')
            @include('academico.cursos._form')
            <div class="flex flex-wrap gap-3">
                <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">Guardar cambios</button>
                <a href="{{ route('academico.cursos.index') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
