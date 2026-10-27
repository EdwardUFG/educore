
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Gestión de cursos
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Administra las materias académicas de EduCore.
                </p>
            </div>

            <a href="{{ route('academico.cursos.create') }}"
               class="inline-flex items-center justify-center px-5 py-3
                      bg-indigo-600 text-white font-semibold rounded-lg
                      hover:bg-indigo-700 transition">
                + Nuevo curso
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Errores de validación --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800">
                    <p class="font-semibold mb-2">
                        Revisa los siguientes errores:
                    </p>
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-xl overflow-hidden">

                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Cursos registrados
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Consulta y administra las materias disponibles.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">
                                    Código
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">
                                    Materia
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">
                                    Carrera
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">
                                    Ciclo
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">
                                    Docente
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">
                                    Acciones
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse ($cursos as $curso)
                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 rounded-md bg-indigo-50 text-indigo-700 text-sm font-semibold">
                                            {{ $curso->codigo }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">
                                            {{ $curso->nombre }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ \Illuminate\Support\Str::limit($curso->descripcion ?? 'Sin descripción', 55) }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $curso->carrera->nombre ?? 'Sin carrera' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $curso->ciclo->nombre ?? 'Sin ciclo' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $curso->docente->name ?? 'Sin docente' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-3">

                                            <a href="{{ route('academico.cursos.show', $curso) }}"
                                               class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">
                                                Ver
                                            </a>

                                            <a href="{{ route('academico.cursos.edit', $curso) }}"
                                               class="text-amber-600 hover:text-amber-800 font-medium text-sm">
                                                Editar
                                            </a>

                                            <form action="{{ route('academico.cursos.destroy', $curso) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('¿Seguro que deseas eliminar este curso?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 font-medium text-sm">
                                                    Eliminar
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="text-gray-400 text-4xl mb-3">
                                            📚
                                        </div>
                                        <p class="text-gray-700 font-semibold">
                                            Todavía no hay cursos registrados.
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Crea tu primer curso para comenzar.
                                        </p>
                                        <a href="{{ route('academico.cursos.create') }}"
                                           class="inline-block mt-4 text-indigo-600 font-semibold hover:underline">
                                            Registrar primer curso
                                        </a>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{-- Paginación --}}
                @if ($cursos->hasPages())
                    <div class="p-6 border-t border-gray-200">
                        {{ $cursos->links() }}
                    </div>
                @endif

            </div>

            <p class="text-sm text-gray-500 mt-4">
                EduCore · Módulo académico · Gestión de cursos
            </p>

        </div>
    </div>
</x-app-layout>
