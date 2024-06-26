<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold leading-tight">Detalle de Cotización</h2>
                        <x-link-button :href="route('cotizaciones.index')">
                            Volver a cotizaciones
                        </x-link-button>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold mb-2">Información de la Cotización</h3>
                        <p class="mb-1"><span class="font-bold">Cliente:</span> {{ $cotizacion->cliente->nombre }}</p>
                        <p class="mb-1"><span class="font-bold">Fecha de Cotización:</span> {{ $cotizacion->fecha_cot }}</p>
                        <p class="mb-1"><span class="font-bold">Vigencia:</span> {{ $cotizacion->vigencia }}</p>
                        <p class="mb-1"><span class="font-bold">Comentarios:</span> {{ $cotizacion->comentarios }}</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-slate-800">
                            <thead class="bg-gray-200 dark:bg-slate-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider w-3/5">Producto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider w-1/5">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100 dark:bg-slate-900/50 divide-y divide-gray-200 dark:divide-slate-700">
                                @foreach ($cotizacion->productos as $producto)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap w-3/5">{{ $producto->nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap w-1/5">{{ $producto->pivot->cantidad }}</td>
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
