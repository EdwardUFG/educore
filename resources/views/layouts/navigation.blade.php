<nav class="flex min-h-screen w-64 shrink-0 flex-col bg-slate-900 px-4 py-6 text-white">
    <a href="{{ route('dashboard') }}" class="mb-10 flex items-center gap-3 px-2">
        <svg class="h-10 w-10 shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5c-2.5-2-5.5-2.5-9-1.5v13c3.5-1 6.5-.5 9 1.5m0-13c2.5-2 5.5-2.5 9-1.5v13c-3.5-1-6.5-.5-9 1.5m0-13v13.5" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.5 9.5c1.7-.3 3.2 0 4.5.8m8.5-.8c-1.7-.3-3.2 0-4.5.8M5.5 13c1.7-.3 3.2 0 4.5.8m8.5-.8c-1.7-.3-3.2 0-4.5.8" />
        </svg>
        <span>
            <span class="block text-xl font-bold tracking-wide">EduCore</span>
            <span class="block text-xs text-slate-300">Universidad</span>
        </span>
    </a>

    <div class="flex flex-1 flex-col gap-2">
        <a href="{{ route('dashboard') }}"
            class="{{ request()->routeIs('dashboard') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition">
            Dashboard
        </a>
        @if (auth()->user()?->rol === 'estudiante')
            <a href="{{ route('mis-notas') }}"
                class="{{ request()->routeIs('mis-notas') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition">
                Mis Notas
            </a>
        @endif
    </div>

    <div class="border-t border-slate-700 pt-4">
        @auth
            <div class="mb-3 px-3">
                <p class="truncate text-sm font-medium">{{ auth()->user()->name }}</p>
                <p class="truncate text-xs text-slate-400">{{ auth()->user()->email }}</p>
            </div>
        @endauth

        <a href="{{ route('profile.edit') }}"
            class="mb-1 block rounded-lg px-3 py-2 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white">
            {{ __('Profile') }}
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full rounded-lg px-3 py-2 text-left text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</nav>
