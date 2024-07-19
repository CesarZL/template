<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl    px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">

                    <!-- Productos más vendidos -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Productos con mayores ventas</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Producto</th>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Cantidad Vendida</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-slate-800">
                                    @foreach($productosMasVendidos as $producto)
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $producto->nombre }}</td>
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $producto->total_cantidad }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Productos con mayores ingresos -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Productos con mayores ingresos</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Producto</th>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Ingresos Totales</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-slate-800">
                                    @foreach($productosMasIngresos as $producto)
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $producto->nombre }}</td>
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">${{ number_format($producto->total_ingresos, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Productos más vendidos en el último mes -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Productos más vendidos en el último mes</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Producto</th>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Cantidad Vendida</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-slate-800">
                                    @foreach($productosUltimoMes as $producto)
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $producto->nombre }}</td>
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $producto->total_cantidad }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Productos menos vendidos -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Productos menos vendidos</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Producto</th>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Cantidad Vendida</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-slate-800">
                                    @foreach($productosMenosVendidos as $producto)
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $producto->nombre }}</td>
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $producto->total_cantidad }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
