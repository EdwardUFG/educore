<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Editar usuario
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow">

                <h3 class="mb-2 text-lg font-bold text-gray-800">
                    Actualizar información
                </h3>

                <p class="mb-6 text-sm text-gray-500">
                    Carnet asignado:
                    <span class="font-semibold">{{ $usuario->carnet }}</span>
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

                <form action="{{ route('administracion.usuarios.update', $usuario) }}"
                      method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="name" class="mb-2 block font-medium">
                            Nombre completo
                        </label>

                        <input type="text" id="name" name="name"
                               value="{{ old('name', $usuario->name) }}"
                               maxlength="255" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div class="mb-5">
                        <label for="email" class="mb-2 block font-medium">
                            Correo electrónico
                        </label>

                        <input type="email" id="email" name="email"
                               value="{{ old('email', $usuario->email) }}"
                               maxlength="255" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block font-medium">
                            Rol
                        </label>

                        <input type="text"
                               value="{{ ucfirst($usuario->rol) }}"
                               disabled
                               class="w-full rounded-lg border-gray-300 bg-gray-100 shadow-sm">

                        <p class="mt-1 text-sm text-gray-500">
                            El rol no se modifica desde este formulario.
                        </p>
                    </div>

                    <div class="mb-5">
                        <label for="carrera_id" class="mb-2 block font-medium">
                            Carrera
                        </label>

                        <select id="carrera_id" name="carrera_id"
                                class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="">Sin carrera asignada</option>

                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}"
                                    @selected((string) old('carrera_id', $usuario->carrera_id) === (string) $carrera->id)>
                                    {{ $carrera->codigo }} - {{ $carrera->nombre }}
                                </option>
                            @endforeach
                        </select>

                        <p class="mt-1 text-sm text-gray-500">
                            Para estudiantes, selecciona una carrera. Para docentes, puede quedar vacía.
                        </p>

                        @error('carrera_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="mb-2 block font-medium">
                            Nueva contraseña (opcional)
                        </label>

                        <input type="password" id="password" name="password"
                               minlength="8" autocomplete="new-password"
                               class="w-full rounded-lg border-gray-300 shadow-sm">

                        <p class="mt-1 text-sm text-gray-500">
                            Déjala vacía para conservar la contraseña actual.
                        </p>

                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit"
                                class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">
                            Guardar cambios
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
