
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalles del curso
            </h2>

            <a href="{{ route('academico.cursos.index') }}"
               class="text-sm text-blue-600 hover:underline">
                Volver a cursos
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Código del curso</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $curso->codigo }}
                        </p>

                        <h3 class="mt-3 text-2xl font-bold text-gray-800">
                            {{ $curso->nombre }}
                        </h3>
                    </div>

                    <a href="{{ route('academico.cursos.edit', $curso) }}"
                       class="rounded-md bg-indigo-600 px-4 py-2 text-center text-white hover:bg-indigo-700">
                        Editar curso
                    </a>
                </div>

                <hr class="my-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Descripción</p>
                        <p class="mt-1 text-gray-800">
                            {{ $curso->descripcion ?: 'Sin descripción' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Carrera</p>
                        <p class="mt-1 text-gray-800">
                            {{ $curso->carrera->nombre ?? 'No asignada' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Ciclo académico</p>
                        <p class="mt-1 text-gray-800">
                            {{ $curso->ciclo->nombre ?? 'No asignado' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Docente</p>
                        <p class="mt-1 text-gray-800">
                            {{ $curso->docente->name ?? 'No asignado' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Estudiantes inscritos
                    </h3>

                    <span class="rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-800">
                        {{ $curso->estudiantes->count() }} estudiantes
                    </span>
                </div>

                @if ($curso->estudiantes->isEmpty())
                    <p class="text-gray-500">
                        Todavía no hay estudiantes inscritos en este curso.
                    </p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                        Carnet
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                        Nombre
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">
                                        Correo
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($curso->estudiantes as $estudiante)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $estudiante->carnet ?? 'Sin carnet' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $estudiante->name }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $estudiante->email }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
