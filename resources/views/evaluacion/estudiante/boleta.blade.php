@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <header class="mb-8">
                <h1 class="text-2xl font-semibold text-slate-900">Mi Boleta de Calificaciones</h1>
            </header>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                @forelse ($cursos as $curso)
                    <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                        <header class="mb-5 flex items-start gap-3 border-b border-slate-100 pb-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v14m0-14C10.7 5.7 8.6 5 6 5H3v14h3c2.6 0 4.7.7 6 2m0-14c1.3-1.3 3.4-2 6-2h3v14h-3c-2.6 0-4.7.7-6 2" />
                                </svg>
                            </span>
                            <div class="min-w-0">
                                <h2 class="text-lg font-semibold leading-6 text-slate-900">{{ $curso->nombre }}</h2>
                                @if ($curso->codigo)
                                    <p class="mt-1 text-sm text-slate-500">{{ $curso->codigo }}</p>
                                @endif
                            </div>
                        </header>

                        <ul class="divide-y divide-slate-100">
                            @php($hayNotas = false)
                            @foreach ($curso->asignaciones as $asignacion)
                                @foreach ($asignacion->notas as $nota)
                                    @php($hayNotas = true)
                                    <li class="flex items-center justify-between gap-4 py-3 first:pt-0">
                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-medium text-slate-800">{{ $asignacion->titulo }}</p>
                                            <p class="mt-1 text-xs text-slate-500">{{ number_format($asignacion->porcentaje, 2) }}%</p>
                                        </div>
                                        <span class="shrink-0 text-sm font-semibold tabular-nums text-slate-900">{{ number_format($nota->valor, 2) }}</span>
                                    </li>
                                @endforeach
                            @endforeach

                            @unless ($hayNotas)
                                <li class="py-3 text-sm text-slate-500">No hay calificaciones registradas.</li>
                            @endunless
                        </ul>

                        <footer class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4">
                            <span class="text-sm font-medium text-slate-600">Promedio acumulado</span>
                            @if ($curso->promedio_acumulado >= 6.00)
                                <div class="rounded-lg bg-emerald-100 px-3 py-1.5 text-sm font-bold text-emerald-800">
                                    {{ number_format($curso->promedio_acumulado, 2) }}
                                </div>
                            @else
                                <div class="rounded-lg bg-rose-100 px-3 py-1.5 text-sm font-bold text-rose-800">
                                    {{ number_format($curso->promedio_acumulado, 2) }}
                                </div>
                            @endif
                        </footer>
                    </article>
                @empty
                    <div class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-12 text-center md:col-span-2">
                        <p class="text-sm font-medium text-slate-700">Inscribe materias primero para consultar tus notas y actividades.</p>
                        <a href="{{ route('academico.inscripciones.index') }}" class="mt-4 inline-flex rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">Inscribir Materias</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
