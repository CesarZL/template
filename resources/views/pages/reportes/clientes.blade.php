<x-app-layout>
    <div class="py-12">
        <div class="max-w-full px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-xl font-semibold mb-4">Reportes de Clientes</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Cantidad de clientes en el último mes -->
                        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow">
                            <h3 class="text-lg font-medium">Clientes en el último mes</h3>
                            <p class="text-2xl font-bold">{{ $clientesUltimoMes }}</p>
                        </div>

                        <!-- Cantidad de clientes en el mes actual -->
                        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow">
                            <h3 class="text-lg font-medium">Clientes en el mes actual</h3>
                            <p class="text-2xl font-bold">{{ $clientesMesActual }}</p>
                        </div>

                        <!-- Incremento de clientes -->
                        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow">
                            <h3 class="text-lg font-medium">Incremento de clientes</h3>
                            <p class="text-2xl font-bold">{{ $incrementoClientes }}</p>
                        </div>
                    </div>

                    <!-- Clientes que más compran -->
                    <div class="mt-8 bg-gray-100 dark:bg-gray-700 rounded-lg shadow p-6">
                        <h3 class="text-lg font-medium mb-4">Clientes que más compran</h3>
                        <ul>
                            @foreach ($clientesQueMasCompran as $cliente)
                                <li class="flex justify-between mb-2">
                                    <span>{{ $cliente->nombre }}</span>
                                    <span>${{ number_format($cliente->total_compras, 2) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Cliente que más ha gastado -->
                    <div class="mt-8 bg-gray-100 dark:bg-gray-700 rounded-lg shadow p-6">
                        <h3 class="text-lg font-medium mb-4">Cliente que más ha gastado</h3>
                        @if ($clienteQueMasGasto)
                            <p>{{ $clienteQueMasGasto->nombre }}</p>
                            <p>${{ number_format($clienteQueMasGasto->total_gasto, 2) }}</p>
                        @else
                            <p>No hay datos disponibles.</p>
                        @endif
                    </div>

                    <!-- Cliente que más productos ha comprado -->
                    <div class="mt-8 bg-gray-100 dark:bg-gray-700 rounded-lg shadow p-6">
                        <h3 class="text-lg font-medium mb-4">Cliente que más productos ha comprado</h3>
                        @if ($clienteQueMasProductos)
                            <p>{{ $clienteQueMasProductos->nombre }}</p>
                            <p>{{ $clienteQueMasProductos->total_productos }} productos</p>
                        @else
                            <p>No hay datos disponibles.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
