<x-app-layout>
    <div class="py-12">
        <div class="max-w-full px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">

                    <!-- Productos con stock bajo -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Productos con Stock Bajo</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Producto</th>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Stock Disponible</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-slate-800">
                                    @foreach($productosStockBajo as $producto)
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $producto->nombre }}</td>
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $producto->total_stock }}</td>
                                        </tr>
                                    @endforeach

                                    @if ($productosStockBajo->isEmpty())
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100" colspan="2">No hay productos con stock bajo</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Productos con stock alto -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Productos con Stock Alto</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Producto</th>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Stock Disponible</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-slate-800">
                                    @foreach($productosStockAlto as $producto)
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $producto->nombre }}</td>
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $producto->total_stock }}</td>
                                        </tr>
                                    @endforeach

                                    @if ($productosStockAlto->isEmpty())
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100" colspan="2">No hay productos con stock alto</td>
                                        </tr>                                        
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Movimientos de inventario recientes -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Movimientos de Inventario Recientes</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Producto</th>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Fecha de Entrada</th>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Cantidad</th>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Movimiento</th>
                                        <th class="py-3 px-6 border-b border-gray-200 dark:border-gray-700 text-left text-sm font-medium text-gray-500 dark:text-gray-200">Motivo</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-slate-800">
                                    @foreach($movimientosRecientes as $movimiento)
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $movimiento->nombre }}</td>
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $movimiento->fecha_entrada}}</td>
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $movimiento->cantidad }}</td>
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $movimiento->movimiento }}</td>
                                            <td class="py-3 px-6 text-sm text-gray-900 dark:text-gray-100">{{ $movimiento->motivo }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Gráfica de stock de productos por categoría -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Stock de Productos por Categoría</h2>
                        <div class="flex justify-center bg-white dark:bg-slate-800 p-4 rounded-lg">
                            <canvas id="stockPorCategoriaChart" class="w-80 h-80"></canvas> <!-- Ajusta el tamaño aquí -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('stockPorCategoriaChart').getContext('2d');
            const stockPorCategoria = @json($stockPorCategoria);

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: stockPorCategoria.map(item => item.categoria),
                    datasets: [{
                        label: 'Stock por Categoría',
                        data: stockPorCategoria.map(item => item.total_stock),
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                        borderColor: '#fff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw} unidades`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

</x-app-layout>
