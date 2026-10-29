<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Gestión de docentes y estudiantes
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">
                        Padrón universitario
                    </h3>
                    <p class="text-sm text-gray-500">
                        Busca y administra los usuarios de la institución.
                    </p>
                </div>

                <a href="{{ route('administracion.usuarios.create') }}"
                   class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    Registrar usuario
                </a>
            </div>

            <form method="GET"
                  action="{{ route('administracion.usuarios.index') }}"
                  class="mb-6 flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow">

                <div class="min-w-[220px] flex-1">
                    <label for="buscar" class="mb-1 block text-sm font-medium">
                        Buscar por nombre o carnet
                    </label>

                    <input type="text"
                           id="buscar"
                           name="buscar"
                           value="{{ $busqueda }}"
                           placeholder="Ej. Juan Pérez o PG26001"
                           class="w-full rounded-lg border-gray-300 shadow-sm">
                </div>

                <div class="min-w-[180px]">
                    <label for="rol" class="mb-1 block text-sm font-medium">
                        Tipo de usuario
                    </label>

                    <select id="rol" name="rol"
                            class="w-full rounded-lg border-gray-300 shadow-sm">
                        <option value="">Todos</option>
                        <option value="docente" @selected($rol === 'docente')>
                            Docentes
                        </option>
                        <option value="estudiante" @selected($rol === 'estudiante')>
                            Estudiantes
                        </option>
                    </select>
                </div>

                <button type="submit"
                        class="rounded-lg bg-gray-800 px-4 py-2 text-white hover:bg-gray-700">
                    Buscar
                </button>

                <a href="{{ route('administracion.usuarios.index') }}"
                   class="rounded-lg bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">
                    Limpiar
                </a>
            </form>

            <div class="overflow-x-auto rounded-lg bg-white shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase">
                                Carnet
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase">
                                Nombre
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase">
                                Correo
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase">
                                Rol
                            </th>
                            <th class="px-5 py-3 text-left text-xs font-bold uppercase">
                                Carrera
                            </th>
                            <th class="px-5 py-3 text-center text-xs font-bold uppercase">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($usuarios as $usuario)
                            <tr>
                                <td class="whitespace-nowrap px-5 py-4 font-medium">
                                    {{ $usuario->carnet }}
                                </td>

                                <td class="px-5 py-4">
                                    {{ $usuario->name }}
                                </td>

                                <td class="px-5 py-4">
                                    {{ $usuario->email }}
                                </td>

                                <td class="px-5 py-4">
                                    @if ($usuario->rol === 'docente')
                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-800">
                                            Docente
                                        </span>
                                    @else
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-sm text-green-800">
                                            Estudiante
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    {{ $usuario->carrera?->nombre ?? 'No asignada' }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-center">
                                    <a href="{{ route('administracion.usuarios.edit', $usuario) }}"
                                       class="mr-2 text-blue-600 hover:underline">
                                        Editar
                                    </a>

                                    <form action="{{ route('administracion.usuarios.destroy', $usuario) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('¿Deseas eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-600 hover:underline">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-5 py-8 text-center text-gray-500">
                                    No se encontraron usuarios con esos criterios.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="border-t border-gray-200 p-4">
                    {{ $usuarios->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
