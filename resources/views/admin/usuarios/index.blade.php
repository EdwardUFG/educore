@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl space-y-6">
        <header>
            <h1 class="text-2xl font-semibold text-slate-900">Gestión de Usuarios</h1>
            <p class="mt-1 text-sm text-slate-600">Usuarios registrados y sus roles en el sistema.</p>
        </header>

        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr><th class="px-5 py-3">Usuario</th><th class="px-5 py-3">Carnet</th><th class="px-5 py-3">Rol</th><th class="px-5 py-3">Carrera</th></tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td class="px-5 py-4"><p class="text-sm font-medium text-slate-900">{{ $usuario->name }}</p><p class="mt-1 text-sm text-slate-500">{{ $usuario->email }}</p></td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $usuario->carnet ?? '—' }}</td>
                            <td class="px-5 py-4 text-sm capitalize text-slate-700">{{ $usuario->rol }}</td>
                            <td class="px-5 py-4 text-sm text-slate-700">{{ $usuario->carrera?->nombre ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $usuarios->links() }}
    </div>
@endsection
