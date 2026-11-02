<nav class="flex min-h-screen w-64 shrink-0 flex-col bg-slate-900 text-white">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-6 py-6">
        <svg class="h-10 w-10 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5c-2.5-2-5.5-2.5-9-1.5v13c3.5-1 6.5-.5 9 1.5m0-13c2.5-2 5.5-2.5 9-1.5v13c-3.5-1-6.5-.5-9 1.5m0-13v13.5" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.5 9.5c1.7-.3 3.2 0 4.5.8m8.5-.8c-1.7-.3-3.2 0-4.5.8M5.5 13c1.7-.3 3.2 0 4.5.8m8.5-.8c-1.7-.3-3.2 0-4.5.8" />
        </svg>
        <span>
            <span class="block text-xl font-bold tracking-wide">EduCore</span>
            <span class="block text-xs text-slate-300">Universidad</span>
        </span>
    </a>

    <div class="flex flex-1 flex-col gap-2 p-4">
        @if(auth()->user()->rol === 'estudiante')
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard', 'panel') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-6v-7h-4v7H4a1 1 0 0 1-1-1V10Z" />
                </svg>
                <span>Inicio</span>
            </a>
            <a href="{{ route('academico.inscripciones.index') }}" class="{{ request()->routeIs('academico.inscripciones.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                </svg>
                <span>Inscribir Materias</span>
            </a>
            <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v14m0-14C10.7 5.7 8.6 5 6 5H3v14h3c2.6 0 4.7.7 6 2m0-14c1.3-1.3 3.4-2 6-2h3v14h-3c-2.6 0-4.7.7-6 2" />
                </svg>
                <span>Materias</span>
            </a>
            <a href="{{ route('mis-notas') }}" class="{{ request()->routeIs('mis-notas') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                </svg>
                <span>Notas</span>
            </a>
        @elseif(auth()->user()->rol === 'docente')
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard', 'panel') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-6v-7h-4v7H4a1 1 0 0 1-1-1V10Z" />
                </svg>
                <span>Inicio</span>
            </a>
            <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v14m0-14C10.7 5.7 8.6 5 6 5H3v14h3c2.6 0 4.7.7 6 2m0-14c1.3-1.3 3.4-2 6-2h3v14h-3c-2.6 0-4.7.7-6 2" />
                </svg>
                <span>Materias</span>
            </a>
            <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-4M9 3h6v4H9V3Zm-1 10 2 2 5-5" />
                </svg>
                <span>Asignación de Tareas</span>
            </a>
            <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                </svg>
                <span>Notas</span>
            </a>
        @elseif(auth()->user()->rol === 'admin')
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard', 'panel') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-6v-7h-4v7H4a1 1 0 0 1-1-1V10Z" />
                </svg>
                <span>Inicio</span>
            </a>
            <a href="{{ route('academico.cursos.index') }}" class="{{ request()->routeIs('academico.cursos.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v14m0-14C10.7 5.7 8.6 5 6 5H3v14h3c2.6 0 4.7.7 6 2m0-14c1.3-1.3 3.4-2 6-2h3v14h-3c-2.6 0-4.7.7-6 2" />
                </svg>
                <span>Materias</span>
            </a>
            <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-4M9 3h6v4H9V3Zm-1 10 2 2 5-5" />
                </svg>
                <span>Asignación de Tareas</span>
            </a>
            <a href="{{ route('notas.index') }}" class="{{ request()->routeIs('notas.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                </svg>
                <span>Notas</span>
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="{{ request()->routeIs('admin.usuarios.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m8-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8-3v6m3-3h-6" />
                </svg>
                <span>Gestión de Usuarios</span>
            </a>
            <a href="{{ route('academico.cursos.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m8-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8-3v6m3-3h-6" />
                </svg>
                <span>Asignar Clases a Docentes</span>
            </a>
            <a href="{{ route('academico.cursos.create') }}" class="{{ request()->routeIs('academico.cursos.create') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                </svg>
                <span>Crear Materias</span>
            </a>
            <a href="{{ route('academico.inscripciones.index') }}" class="{{ request()->routeIs('academico.inscripciones.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition">
                <svg class="h-5 w-5 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11a4 4 0 1 0-8 0 4 4 0 0 0 8 0ZM3 21a7 7 0 0 1 14 0m3-11v6m3-3h-6" />
                </svg>
                <span>Inscribir Materias</span>
            </a>
        @endif
    </div>

    <div class="border-t border-slate-700 p-4">
        <div class="mb-3 px-3">
            <p class="truncate text-sm font-medium">{{ auth()->user()->name }}</p>
            <p class="truncate text-xs text-slate-400">{{ auth()->user()->email }}</p>
        </div>

        <a href="{{ route('profile.edit') }}" class="mb-1 block rounded-lg px-3 py-2 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white">
            {{ __('Profile') }}
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</nav>
