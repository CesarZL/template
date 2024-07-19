<x-app-layout>
    <div class="py-12">
        <div class="max-w-full px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold mb-4">Reporte de Proveedores</h2>

                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <!-- Total de Compras por Proveedor -->
                        <div class="bg-white dark:bg-slate-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Total de Compras por Proveedor</h3>
                            <ul>
                                @foreach ($totalComprasPorProveedor as $proveedor)
                                    <li>{{ $proveedor->nombre }}: ${{ number_format($proveedor->total_compras, 2) }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Número de Compras por Proveedor -->
                        <div class="bg-white dark:bg-slate-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Número de Compras por Proveedor</h3>
                            <ul>
                                @foreach ($numeroComprasPorProveedor as $proveedor)
                                    <li>{{ $proveedor->nombre }}: {{ $proveedor->numero_compras }} compras</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Proveedor con Mayor Descuento -->
                        <div class="bg-white dark:bg-slate-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Proveedor con Mayor Descuento</h3>
                            @if ($proveedorMayorDescuento)
                                <p>{{ $proveedorMayorDescuento->nombre }}: ${{ number_format($proveedorMayorDescuento->max_descuento, 2) }} de descuento</p>
                            @else
                                <p>No hay datos disponibles.</p>
                            @endif
                        </div>

                        <!-- Proveedor con Mayor Cantidad de Productos Comprados -->
                        <div class="bg-white dark:bg-slate-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Proveedor con Mayor Cantidad de Productos Comprados</h3>
                            @if ($proveedorMayorCantidadProductos)
                                <p>{{ $proveedorMayorCantidadProductos->nombre }}: {{ $proveedorMayorCantidadProductos->total_cantidad }} productos</p>
                            @else
                                <p>No hay datos disponibles.</p>
                            @endif
                        </div>

                        <!-- Proveedores Nuevos en el Último Mes -->
                        <div class="bg-white dark:bg-slate-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Proveedores Nuevos en el Último Mes</h3>
                            <p>{{ $proveedoresNuevosUltimoMes }} nuevos proveedores</p>
                        </div>

                        <!-- Proveedores Activos vs Inactivos -->
                        <div class="bg-white dark:bg-slate-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Proveedores Activos vs. Inactivos</h3>
                            <p>Activos: {{ $proveedoresActivos }}</p>
                            <p>Inactivos: {{ $proveedoresInactivos }}</p>
                        </div>

                        <!-- Proveedores con Compras Recientes -->
                        <div class="bg-white dark:bg-slate-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Proveedores con Compras Recientes</h3>
                            <ul>
                                @foreach ($proveedoresConComprasRecientes as $proveedor)
                                    <li>{{ $proveedor->nombre }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
