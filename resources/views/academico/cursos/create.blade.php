
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Registrar nuevo curso
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-xl p-6 sm:p-8">

                <p class="text-gray-500 mb-6">
                    Completa la información académica de la materia.
                </p>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                        <p class="font-semibold mb-2">
                            Corrige los siguientes errores:
                        </p>
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('academico.cursos.store') }}"
                      method="POST"
                      class="space-y-6">

                    @csrf

                    <div>
                        <label for="codigo"
                               class="block text-sm font-semibold text-gray-700 mb-2">
                            Código de la materia
                        </label>

                        <input type="text"
                               id="codigo"
                               name="codigo"
                               value="{{ old('codigo') }}"
                               maxlength="20"
                               placeholder="Ej. BDD101"
                               required
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                        @error('codigo')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nombre"
                               class="block text-sm font-semibold text-gray-700 mb-2">
                            Nombre de la materia
                        </label>

                        <input type="text"
                               id="nombre"
                               name="nombre"
                               value="{{ old('nombre') }}"
                               placeholder="Ej. Base de Datos I"
                               required
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                        @error('nombre')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="descripcion"
                               class="block text-sm font-semibold text-gray-700 mb-2">
                            Descripción
                        </label>

                        <textarea id="descripcion"
                                  name="descripcion"
                                  rows="3"
                                  placeholder="Describe brevemente la materia"
                                  class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label for="carrera_id"
                                   class="block text-sm font-semibold text-gray-700 mb-2">
                                Carrera
                            </label>

                            <select id="carrera_id"
                                    name="carrera_id"
                                    required
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                                <option value="">Selecciona una carrera</option>

                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}"
                                        @selected(old('carrera_id') == $carrera->id)>
                                        {{ $carrera->codigo }} - {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($carreras->isEmpty())
                                <p class="text-sm text-amber-600 mt-1">
                                    No hay carreras activas registradas.
                                </p>
                            @endif

                            @error('carrera_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="ciclo_id"
                                   class="block text-sm font-semibold text-gray-700 mb-2">
                                Ciclo académico
                            </label>

                            <select id="ciclo_id"
                                    name="ciclo_id"
                                    required
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                                <option value="">Selecciona un ciclo</option>

                                @foreach ($ciclos as $ciclo)
                                    <option value="{{ $ciclo->id }}"
                                        @selected(old('ciclo_id') == $ciclo->id)>
                                        {{ $ciclo->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($ciclos->isEmpty())
                                <p class="text-sm text-amber-600 mt-1">
                                    No hay ciclos activos registrados.
                                </p>
                            @endif

                            @error('ciclo_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div>
                        <label for="docente_id"
                               class="block text-sm font-semibold text-gray-700 mb-2">
                            Docente encargado
                        </label>

                        <select id="docente_id"
                                name="docente_id"
                                required
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                            <option value="">Selecciona un docente</option>

                            @foreach ($docentes as $docente)
                                <option value="{{ $docente->id }}"
                                    @selected(old('docente_id') == $docente->id)>
                                    {{ $docente->name }}
                                    @if ($docente->carnet)
                                        - {{ $docente->carnet }}
                                    @endif
                                </option>
                            @endforeach
                        </select>

                        @if ($docentes->isEmpty())
                            <p class="text-sm text-amber-600 mt-1">
                                No hay usuarios con el rol docente registrados.
                            </p>
                        @endif

                        @error('docente_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4 border-t">

                        <a href="{{ route('academico.cursos.index') }}"
                           class="px-5 py-3 text-center rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                            Cancelar
                        </a>

                        <button type="submit"
                                @disabled($carreras->isEmpty() || $ciclos->isEmpty() || $docentes->isEmpty())
                                class="px-5 py-3 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed">
                            Guardar curso
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
