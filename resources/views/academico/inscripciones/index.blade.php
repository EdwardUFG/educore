@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl space-y-6">
        <header>
            <h1 class="text-2xl font-semibold text-slate-900">
                {{ auth()->user()->rol === 'admin' ? 'Gestión de inscripciones' : 'Inscribir materias' }}
            </h1>
            <p class="mt-1 text-sm text-slate-600">
                {{ auth()->user()->rol === 'admin' ? 'Administra la matrícula de estudiantes por materia.' : 'Selecciona las materias disponibles para tu matrícula.' }}
            </p>
        </header>

        @if (session('success'))
            <p role="status" class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div role="alert" class="rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (auth()->user()->rol === 'admin')
            <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Inscribir estudiante</h2>
                <form method="POST" action="{{ route('academico.inscripciones.store') }}" class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
                    @csrf
                    <label class="block text-sm font-medium text-slate-700">
                        Materia
                        <select name="curso_id" required class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500">
                            <option value="">Selecciona una materia</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" @selected(old('curso_id') == $curso->id)>{{ $curso->codigo }} · {{ $curso->nombre }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block text-sm font-medium text-slate-700">
                        Estudiante
                        <select name="estudiante_id" required class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500">
                            <option value="">Selecciona un estudiante</option>
                            @foreach ($estudiantes as $estudiante)
                                <option value="{{ $estudiante->id }}" @selected(old('estudiante_id') == $estudiante->id)>{{ $estudiante->name }} · {{ $estudiante->carnet }}</option>
                            @endforeach
                        </select>
                    </label>
                    <div class="flex items-end">
                        <button type="submit" class="w-full rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">Registrar inscripción</button>
                    </div>
                </form>
            </section>

            <section class="space-y-4">
                @forelse ($cursos as $curso)
                    <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div>
                                <h2 class="font-semibold text-slate-900">{{ $curso->nombre }}</h2>
                                <p class="mt-1 text-sm text-slate-500">{{ $curso->codigo }} · {{ $curso->carrera->nombre }} · {{ $curso->estudiantes_count }} estudiantes</p>
                            </div>
                            <p class="text-sm text-slate-600">Docente: {{ $curso->docente->name }}</p>
                        </div>
                        @if ($curso->estudiantes->isNotEmpty())
                            <ul class="mt-4 divide-y divide-slate-100 border-t border-slate-100">
                                @foreach ($curso->estudiantes as $estudiante)
                                    <li class="flex flex-wrap items-center justify-between gap-3 py-3">
                                        <span class="text-sm text-slate-700">{{ $estudiante->name }} · {{ $estudiante->carnet }}</span>
                                        <form method="POST" action="{{ route('academico.inscripciones.destroy', [$curso, $estudiante]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-rose-700 hover:text-rose-900">Retirar</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mt-4 border-t border-slate-100 pt-4 text-sm text-slate-500">Sin estudiantes inscritos.</p>
                        @endif
                    </article>
                @empty
                    <p class="rounded-xl border border-dashed border-slate-300 bg-white p-6 text-sm text-slate-600">No hay materias registradas.</p>
                @endforelse
            </section>
        @else
            @if ($cursos->isEmpty())
                <div class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-12 text-center">
                    <p class="text-sm font-medium text-slate-700">No hay materias disponibles para inscripción.</p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($cursos as $curso)
                        <article class="flex flex-col rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                            <div class="flex-1">
                                <h2 class="font-semibold text-slate-900">{{ $curso->nombre }}</h2>
                                <p class="mt-1 text-sm text-slate-500">{{ $curso->codigo }} · {{ $curso->carrera->nombre }}</p>
                                <p class="mt-3 text-sm text-slate-600">{{ $curso->docente->name }}</p>
                                <p class="mt-1 text-sm text-slate-500">{{ $curso->ciclo->nombre }}</p>
                            </div>
                            <form method="POST" action="{{ route('academico.inscripciones.store') }}" class="mt-5">
                                @csrf
                                <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                                <button type="submit" class="w-full rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">Inscribirme</button>
                            </form>
                        </article>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
@endsection
