<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Registrar usuario
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow">

                <h3 class="mb-2 text-lg font-bold text-gray-800">
                    Nuevo docente o estudiante
                </h3>

                <p class="mb-6 text-sm text-gray-500">
                    El carnet se generará automáticamente al guardar.
                </p>

                @if ($errors->any())
                    <div class="mb-5 rounded-lg bg-red-100 p-4 text-red-800">
                        <ul class="list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('administracion.usuarios.store') }}"
                      method="POST">
                    @csrf

                    <div class="mb-5">
                        <label for="name" class="mb-2 block font-medium">
                            Nombre completo
                        </label>

                        <input type="text" id="name" name="name"
                               value="{{ old('name') }}"
                               maxlength="255" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="email" class="mb-2 block font-medium">
                            Correo electrónico
                        </label>

                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               maxlength="255" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">

                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="rol" class="mb-2 block font-medium">
                            Tipo de usuario
                        </label>

                        <select id="rol" name="rol" required
                                class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="">Selecciona un rol</option>
                            <option value="docente" @selected(old('rol') === 'docente')>
                                Docente
                            </option>
                            <option value="estudiante" @selected(old('rol') === 'estudiante')>
                                Estudiante
                            </option>
                        </select>

                        @error('rol')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="carrera_id" class="mb-2 block font-medium">
                            Carrera
                        </label>

                        <select id="carrera_id" name="carrera_id"
                                class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="">Selecciona una carrera</option>

                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}"
                                    @selected((string) old('carrera_id') === (string) $carrera->id)>
                                    {{ $carrera->codigo }} - {{ $carrera->nombre }}
                                </option>
                            @endforeach
                        </select>

                        <p class="mt-1 text-sm text-gray-500">
                            Obligatoria para estudiantes. Los docentes no necesitan una carrera asignada.
                        </p>

                        @error('carrera_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="mb-2 block font-medium">
                            Contraseña inicial
                        </label>

                        <input type="password" id="password" name="password"
                               minlength="8" required autocomplete="new-password"
                               class="w-full rounded-lg border-gray-300 shadow-sm">

                        <p class="mt-1 text-sm text-gray-500">
                            Debe contener al menos 8 caracteres.
                        </p>

                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit"
                                class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">
                            Registrar usuario
                        </button>

                        <a href="{{ route('administracion.usuarios.index') }}"
                           class="rounded-lg bg-gray-200 px-5 py-2 text-gray-700 hover:bg-gray-300">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
