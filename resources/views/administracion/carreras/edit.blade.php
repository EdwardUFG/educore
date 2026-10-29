<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Editar carrera
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow">

                <h3 class="mb-6 text-lg font-bold text-gray-800">
                    Actualizar información de la carrera
                </h3>

                @if ($errors->any())
                    <div class="mb-5 rounded-lg bg-red-100 p-4 text-red-800">
                        <ul class="list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('administracion.carreras.update', $carrera) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="codigo"
                               class="mb-2 block font-medium text-gray-700">
                            Código de la carrera
                        </label>

                        <input
                            type="text"
                            id="codigo"
                            name="codigo"
                            value="{{ old('codigo', $carrera->codigo) }}"
                            maxlength="255"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm
                                   focus:border-blue-500 focus:ring-blue-500">

                        @error('codigo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="nombre"
                               class="mb-2 block font-medium text-gray-700">
                            Nombre de la carrera
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            value="{{ old('nombre', $carrera->nombre) }}"
                            maxlength="255"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm
                                   focus:border-blue-500 focus:ring-blue-500">

                        @error('nombre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="facultad"
                               class="mb-2 block font-medium text-gray-700">
                            Facultad
                        </label>

                        <input
                            type="text"
                            id="facultad"
                            name="facultad"
                            value="{{ old('facultad', $carrera->facultad) }}"
                            maxlength="255"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm
                                   focus:border-blue-500 focus:ring-blue-500">

                        @error('facultad')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="inline-flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="activa"
                                value="1"
                                @checked(old('activa', $carrera->activa))
                                class="rounded border-gray-300 text-blue-600
                                       shadow-sm focus:ring-blue-500">

                            <span class="text-gray-700">
                                Carrera activa
                            </span>
                        </label>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button
                            type="submit"
                            class="rounded-lg bg-blue-600 px-5 py-2
                                   font-medium text-white hover:bg-blue-700">
                            Guardar cambios
                        </button>

                        <a
                            href="{{ route('administracion.carreras.index') }}"
                            class="rounded-lg bg-gray-200 px-5 py-2
                                   font-medium text-gray-700 hover:bg-gray-300">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
