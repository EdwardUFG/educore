<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Gestión de carreras
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

            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">
                        Carreras registradas
                    </h3>

                    <p class="text-sm text-gray-500">
                        Administra las carreras de la institución.
                    </p>
                </div>

                <a href="{{ route('administracion.carreras.create') }}"
                   class="rounded-lg bg-blue-600 px-4 py-2
                          text-white hover:bg-blue-700">
                    Nueva carrera
                </a>
            </div>

            <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                    Código
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                    Nombre
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                    Facultad
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                    Estado
                                </th>

                                <th class="px-6 py-3 text-center text-xs font-bold uppercase">
                                    Acciones
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($carreras as $carrera)
                                <tr>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        {{ $carrera->codigo }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $carrera->nombre }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $carrera->facultad }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($carrera->activa)
                                            <span class="rounded-full bg-green-100 px-3 py-1 text-sm text-green-800">
                                                Activa
                                            </span>
                                        @else
                                            <span class="rounded-full bg-gray-100 px-3 py-1 text-sm text-gray-700">
                                                Inactiva
                                            </span>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-center">
                                        <a href="{{ route('administracion.carreras.edit', $carrera) }}"
                                           class="mr-3 text-blue-600 hover:underline">
                                            Editar
                                        </a>

                                        <form action="{{ route('administracion.carreras.destroy', $carrera) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('¿Deseas eliminar esta carrera?');">
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
                                    <td colspan="5"
                                        class="px-6 py-8 text-center text-gray-500">
                                        Todavía no hay carreras registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 p-4">
                    {{ $carreras->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>