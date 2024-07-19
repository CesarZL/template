<x-app-layout>
    <div class="py-12">
        <div class="max-w-full px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <div class="overflow-x-auto flex justify-between items-center mb-4 sm:pb-3 md:pb-3 pb-3">
                        <h2 class="text-2xl font-semibold leading-tight sm:mr-5 md:mr-5 lg:mr-5 xl:mr-5 mr-10">Productos</h2>
                       <div class="flex justify-end space-x-3">
                            <x-link-button class="btn bg-green-700 hover:bg-green-600 text-white whitespace-nowrap" :href="route('productos.create')">
                                Nuevo producto
                            </x-link-button>

                            <x-link-button :href="route('reportes.productos')">
                                Ver reporte de productos
                            </x-link-button>
                       </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-slate-800">
                            <thead class="bg-gray-200 dark:bg-slate-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Fecha de compra</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Descripción Corta</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Descripción Larga</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Precio Compra</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Precio Venta</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Categoria</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Color</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100 dark:bg-slate-900/50 divide-y divide-gray-200 dark:divide-slate-700">
                                @foreach ($productos as $producto)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->ultima_compra }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->descripcion_corta }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->descripcion_larga }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->precio_compra }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->precio_venta }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->categoria->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $producto->color }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('productos.show', $producto->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                        <a href="{{ route('productos.edit', $producto->id) }}" class="text-yellow-600 hover:text-yellow-900 ml-4">Editar</a>
                                        <a href="{{ route('productos.destroy', $producto) }}" class="text-red-600 hover:text-red-900 ml-4" data-confirm-delete="true">
                                            Borrar
                                        </a>
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