
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Gestión de inscripciones
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Inscribe estudiantes y administra su participación en los cursos.
                </p>
            </div>

            <a href="{{ route('academico.cursos.index') }}"
               class="text-sm text-indigo-600 hover:underline">
                Volver a cursos
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="rounded-md bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-md bg-red-100 p-4 text-red-800">
                    <p class="font-semibold">No se pudo completar la operación:</p>
                    <ul class="mt-2 list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario para inscribir estudiantes --}}
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800">
                    Inscribir estudiante
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Selecciona el curso y el estudiante que deseas inscribir.
                </p>

                @if ($cursos->isEmpty())
                    <p class="mt-4 text-amber-700">
                        No hay cursos registrados. Registra un curso antes de continuar.
                    </p>
                @elseif ($estudiantes->isEmpty())
                    <p class="mt-4 text-amber-700">
                        No hay usuarios con rol de estudiante registrados.
                    </p>
                @else
                    <form method="POST"
                          action="{{ route('academico.inscripciones.store') }}"
                          class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-3">
                        @csrf

                        <div>
                            <label for="curso_id"
                                   class="mb-1 block text-sm font-medium text-gray-700">
                                Curso
                            </label>

                            <select id="curso_id"
                                    name="curso_id"
                                    required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona un curso</option>

                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}"
                                        @selected(
                                            (string) old('curso_id', $cursoSeleccionado)
                                            === (string) $curso->id
                                        )>
                                        {{ $curso->codigo }} - {{ $curso->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="estudiante_id"
                                   class="mb-1 block text-sm font-medium text-gray-700">
                                Estudiante
                            </label>

                            <select id="estudiante_id"
                                    name="estudiante_id"
                                    required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona un estudiante</option>

                                @foreach ($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}"
                                        @selected(
                                            (string) old('estudiante_id') === (string) $estudiante->id
                                        )>
                                        {{ $estudiante->carnet ? $estudiante->carnet . ' - ' : '' }}{{ $estudiante->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-end">
                            <button type="submit"
                                    class="w-full rounded-md bg-indigo-600 px-4 py-2.5 font-semibold text-white hover:bg-indigo-700">
                                Inscribir estudiante
                            </button>
                        </div>
                    </form>
                @endif
            </div>

            {{-- Listado de cursos e inscritos --}}
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <div class="mb-5">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Cursos e inscritos
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Consulta los estudiantes registrados en cada curso.
                    </p>
                </div>

                @forelse ($cursos as $curso)
                    <div class="mb-5 overflow-hidden rounded-lg border border-gray-200 last:mb-0">
                        <div class="flex flex-col gap-3 bg-gray-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm font-medium text-indigo-600">
                                    {{ $curso->codigo }}
                                </p>

                                <h4 class="font-semibold text-gray-900">
                                    {{ $curso->nombre }}
                                </h4>

                                <p class="mt-1 text-sm text-gray-500">
                                    Carrera: {{ $curso->carrera->nombre ?? 'No asignada' }}
                                    · Ciclo: {{ $curso->ciclo->nombre ?? 'No asignado' }}
                                </p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="rounded-full bg-indigo-100 px-3 py-1 text-sm text-indigo-800">
                                    {{ $curso->estudiantes_count }}
                                    {{ $curso->estudiantes_count === 1 ? 'estudiante' : 'estudiantes' }}
                                </span>

                                <a href="{{ route('academico.inscripciones.index', ['curso' => $curso->id]) }}"
                                   class="text-sm font-medium text-indigo-600 hover:underline">
                                    Inscribir aquí
                                </a>
                            </div>
                        </div>

                        @if ($cursoSeleccionado && (string) $cursoSeleccionado === (string) $curso->id)
                            @php
                                $curso->load('estudiantes');
                            @endphp

                            <div class="p-4">
                                <h5 class="mb-3 font-medium text-gray-800">
                                    Estudiantes inscritos en este curso
                                </h5>

                                @if ($curso->estudiantes->isEmpty())
                                    <p class="text-sm text-gray-500">
                                        Este curso todavía no tiene estudiantes inscritos.
                                    </p>
                                @else
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-white">
                                                <tr>
                                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                                        Carnet
                                                    </th>
                                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                                        Estudiante
                                                    </th>
                                                    <th class="px-3 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                                        Correo
                                                    </th>
                                                    <th class="px-3 py-3 text-right text-xs font-medium uppercase text-gray-500">
                                                        Acción
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody class="divide-y divide-gray-200">
                                                @foreach ($curso->estudiantes as $estudiante)
                                                    <tr>
                                                        <td class="px-3 py-3 text-sm text-gray-700">
                                                            {{ $estudiante->carnet ?? 'Sin carnet' }}
                                                        </td>

                                                        <td class="px-3 py-3 text-sm text-gray-700">
                                                            {{ $estudiante->name }}
                                                        </td>

                                                        <td class="px-3 py-3 text-sm text-gray-700">
                                                            {{ $estudiante->email }}
                                                        </td>

                                                        <td class="px-3 py-3 text-right">
                                                            <form method="POST"
                                                                  action="{{ route('academico.inscripciones.destroy', ['curso' => $curso->id, 'estudiante' => $estudiante->id]) }}"
                                                                  onsubmit="return confirm('¿Seguro que deseas retirar a este estudiante del curso?');">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit"
                                                                        class="text-sm font-medium text-red-600 hover:text-red-800">
                                                                    Retirar
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">
                        No hay cursos disponibles para mostrar.
                    </p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
