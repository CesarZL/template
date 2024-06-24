<x-app-layout>
    <div class="py-12">
        <div class="max-w-full px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold leading-tight">Inventarios</h2>
                        <x-link-button :href="route('inventarios.create')">
                            Nueva entrada
                        </x-link-button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-slate-800">
                            <thead class="bg-gray-200 dark:bg-slate-700">
                                <tr>
                                    <th class="w-1/3 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Producto</th>
                                    <th class="w-1/3 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Categoria</th>
                                    <th class="w-1/3 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Fecha entrada</th>
                                    <th class="w-1/3 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Fecha salida</th>
                                    <th class="w-1/3 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Movimiento</th>
                                    <th class="w-1/3 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Motivo</th>
                                    <th class="w-1/3 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Cantidad</th>
                                    <th class="w-1/3 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100 dark:bg-slate-900/50 divide-y divide-gray-200 dark:divide-slate-700">
                                @foreach ($inventarios as $inventario)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $inventario->producto->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $inventario->producto->categoria->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $inventario->fecha_entrada }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $inventario->fecha_salida }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $inventario->movimiento }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $inventario->motivo }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $inventario->cantidad }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('inventarios.show', $inventario->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                        <a href="{{ route('inventarios.edit', $inventario->id) }}" class="text-yellow-600 hover:text-yellow-900 ml-4">Editar</a>
                                        <form action="{{ route('inventarios.destroy', $inventario->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>