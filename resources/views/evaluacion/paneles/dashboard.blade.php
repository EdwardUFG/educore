@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <header>
                <h1 class="text-2xl font-semibold text-slate-900">
                    Bienvenido/a, {{ auth()->user()->name }}
                </h1>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ ucfirst(auth()->user()->rol) }}
                </p>
            </header>

            <section class="mt-6 flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-8 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 shrink-0 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <rect x="3" y="3" width="18" height="18" rx="2" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3v18m6-12h2m-2 4h2M5.5 7h1m-1 4h1m-1 4h1" />
                </svg>
                <p class="max-w-3xl text-sm leading-6 text-slate-600">
                    Selecciona una opción del menú lateral para gestionar los recursos académicos y las calificaciones.
                </p>
            </section>
        </div>
    </div>
@endsection
