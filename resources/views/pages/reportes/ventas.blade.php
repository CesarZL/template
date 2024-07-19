<x-app-layout>
    <div class="py-12">
        <div class="max-w-full px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold mb-6">Reporte de Ventas</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-100 dark:bg-slate-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Venta más grande</h3>
                            <p>Total: ${{ number_format($ventaMax->total, 2) }}</p>
                            <p>Fecha: {{ $ventaMax->fecha_de_venta }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-slate-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Venta más pequeña</h3>
                            <p>Total: ${{ number_format($ventaMin->total, 2) }}</p>
                            <p>Fecha: {{ $ventaMin->fecha_de_venta }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-100 dark:bg-slate-700 p-4 rounded-lg shadow mb-6">
                        <h3 class="text-lg font-semibold mb-2">Ventas por Mes</h3>
                        <canvas id="ventasPorMesChart"></canvas>
                    </div>

                    <div class="bg-gray-100 dark:bg-slate-700 p-4 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-2">Mejores Ventas del Mes Actual</h3>
                        <table class="w-full text-left">
                            <thead>
                                <tr>
                                    <th class="border-b-2 dark:border-slate-600">Total</th>
                                    <th class="border-b-2 dark:border-slate-600">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ventasMesActual as $venta)
                                    <tr>
                                        <td class="border-b dark:border-slate-600">${{ number_format($venta->total, 2) }}</td>
                                        <td class="border-b dark:border-slate-600">{{ $venta->fecha_de_venta }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('ventasPorMesChart').getContext('2d');
            var ventasPorMesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($ventasPorMes->pluck('mes')),
                    datasets: [{
                        label: 'Ventas por Mes',
                        data: @json($ventasPorMes->pluck('total_ventas')),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
