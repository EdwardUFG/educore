@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl">
        <header>
            <h1 class="text-2xl font-semibold text-slate-900">Bienvenido/a, {{ auth()->user()->name }}</h1>
            <p class="mt-1 text-sm font-medium text-slate-500">{{ ucfirst(auth()->user()->rol) }}</p>
        </header>

        <section aria-labelledby="wall-title" class="mt-6">
            <h2 id="wall-title" class="text-xl font-semibold text-slate-900">Muro Universitario</h2>

            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
                <section aria-labelledby="announcements-title" class="space-y-4 lg:col-span-2">
                    <h3 id="announcements-title" class="text-lg font-semibold text-slate-900">Anuncios y Eventos</h3>

                    <article class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-start gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14H3V6a2 2 0 0 1 2-2Zm3 10h3m-3 4h8" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-indigo-700">Aviso académico</p>
                                <h4 class="mt-1 text-lg font-semibold text-slate-900">Semana de Parciales - Ciclo 02</h4>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Consulta las fechas de evaluación con tus docentes y organiza con anticipación tus actividades académicas.</p>
                            </div>
                        </div>
                    </article>

                    <article class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-start gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v3m0 12v3M4.93 4.93l2.12 2.12m9.9 9.9 2.12 2.12M3 12h3m12 0h3M4.93 19.07l2.12-2.12m9.9-9.9 2.12-2.12M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Comunidad universitaria</p>
                                <h4 class="mt-1 text-lg font-semibold text-slate-900">Jornada de Horas Sociales y Proyectos Tech</h4>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Conoce oportunidades para colaborar en proyectos tecnológicos y cumplir tus horas sociales junto a la comunidad universitaria.</p>
                            </div>
                        </div>
                    </article>
                </section>

                <aside aria-labelledby="information-title" class="space-y-4">
                    <h3 id="information-title" class="text-lg font-semibold text-slate-900">Normativa e Información</h3>

                    <div class="divide-y divide-slate-100 rounded-xl border border-slate-200 bg-white px-5 shadow-sm">
                        <a href="#" class="flex items-center gap-3 py-4 text-sm font-medium text-slate-700 transition hover:text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h12v18l-6-4-6 4V3Zm3 5h6m-6 4h6" />
                            </svg>
                            <span>Reglamento Académico</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 py-4 text-sm font-medium text-slate-700 transition hover:text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14H3V6a2 2 0 0 1 2-2Zm3 10h3m-3 4h8" />
                            </svg>
                            <span>Calendario de Actividades</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 py-4 text-sm font-medium text-slate-700 transition hover:text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 6v5c0 5 3.4 8.5 8 10 4.6-1.5 8-5 8-10V6l-8-3Zm-3 9 2 2 4-4" />
                            </svg>
                            <span>Manual de Convivencia</span>
                        </a>
                    </div>
                </aside>
            </div>
        </section>
    </div>
@endsection
