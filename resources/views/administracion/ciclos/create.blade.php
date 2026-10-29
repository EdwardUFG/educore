<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Registrar ciclo académico
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow">

                <h3 class="mb-6 text-lg font-bold text-gray-800">
                    Nuevo ciclo académico
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

                <form action="{{ route('administracion.ciclos.store') }}"
                      method="POST">
                    @csrf

                    <div class="mb-5">
                        <label for="nombre" class="mb-2 block font-medium">
                            Nombre del ciclo
                        </label>
                        <input type="text" id="nombre" name="nombre"
                               value="{{ old('nombre') }}"
                               maxlength="255" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div class="mb-5">
                        <label for="fecha_inicio" class="mb-2 block font-medium">
                            Fecha de inicio
                        </label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio"
                               value="{{ old('fecha_inicio') }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div class="mb-5">
                        <label for="fecha_fin" class="mb-2 block font-medium">
                            Fecha de finalización
                        </label>
                        <input type="date" id="fecha_fin" name="fecha_fin"
                               value="{{ old('fecha_fin') }}" required
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div class="mb-6">
                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" name="activo" value="1"
                                   @checked(old('activo', true))
                                   class="rounded border-gray-300 text-blue-600">
                            <span>Ciclo activo</span>
                        </label>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit"
                                class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">
                            Guardar ciclo
                        </button>

                        <a href="{{ route('administracion.ciclos.index') }}"
                           class="rounded-lg bg-gray-200 px-5 py-2 text-gray-700 hover:bg-gray-300">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
