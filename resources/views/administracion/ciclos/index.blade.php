<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Gestión de ciclos académicos
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
                        Ciclos registrados
                    </h3>
                    <p class="text-sm text-gray-500">
                        Administra los períodos académicos.
                    </p>
                </div>

                <a href="{{ route('administracion.ciclos.create') }}"
                   class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    Nuevo ciclo
                </a>
            </div>

            <div class="overflow-x-auto rounded-lg bg-white shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                Nombre
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                Fecha de inicio
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                Fecha de fin
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                Estado
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-bold uppercase">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($ciclos as $ciclo)
                            <tr>
                                <td class="px-6 py-4">
                                    {{ $ciclo->nombre }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Illuminate\Support\Carbon::parse($ciclo->fecha_inicio)->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Illuminate\Support\Carbon::parse($ciclo->fecha_fin)->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($ciclo->activo)
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-sm text-green-800">
                                            Activo
                                        </span>
                                    @else
                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-sm text-gray-700">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-center">
                                    <a href="{{ route('administracion.ciclos.edit', $ciclo) }}"
                                       class="mr-3 text-blue-600 hover:underline">
                                        Editar
                                    </a>

                                    <form action="{{ route('administracion.ciclos.destroy', $ciclo) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('¿Deseas eliminar este ciclo académico?');">
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
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    Todavía no hay ciclos académicos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="border-t p-4">
                    {{ $ciclos->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
