
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Editar curso
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl p-6 sm:p-8">

                <p class="text-gray-500 mb-6">
                    Modifica la información de {{ $curso->nombre }}.
                </p>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('academico.cursos.update', $curso) }}"
                      method="POST"
                      class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="codigo" class="block text-sm font-semibold text-gray-700 mb-2">
                            Código
                        </label>
                        <input id="codigo" name="codigo" type="text" maxlength="20"
                               value="{{ old('codigo', $curso->codigo) }}"
                               required
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('codigo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nombre de la materia
                        </label>
                        <input id="nombre" name="nombre" type="text"
                               value="{{ old('nombre', $curso->nombre) }}"
                               required
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nombre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-2">
                            Descripción
                        </label>
                        <textarea id="descripcion" name="descripcion" rows="3"
                                  class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion', $curso->descripcion) }}</textarea>
                        @error('descripcion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="carrera_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Carrera
                            </label>
                            <select id="carrera_id" name="carrera_id" required
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}"
                                        @selected(old('carrera_id', $curso->carrera_id) == $carrera->id)>
                                        {{ $carrera->codigo }} - {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('carrera_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="ciclo_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Ciclo académico
                            </label>
                            <select id="ciclo_id" name="ciclo_id" required
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona un ciclo</option>
                                @foreach ($ciclos as $ciclo)
                                    <option value="{{ $ciclo->id }}"
                                        @selected(old('ciclo_id', $curso->ciclo_id) == $ciclo->id)>
                                        {{ $ciclo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ciclo_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="docente_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Docente encargado
                        </label>
                        <select id="docente_id" name="docente_id" required
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Selecciona un docente</option>
                            @foreach ($docentes as $docente)
                                <option value="{{ $docente->id }}"
                                    @selected(old('docente_id', $curso->docente_id) == $docente->id)>
                                    {{ $docente->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('docente_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('academico.cursos.index') }}"
                           class="px-5 py-3 text-center rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="px-5 py-3 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
