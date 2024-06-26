{{-- $table->foreignId('producto_id')->constrained()->onDelete('cascade');
$table->foreignId('cliente_id')->constrained()->onDelete('cascade');
$table->date('fecha_cot');
$table->integer('Vigencia');
$table->text('comentarios')->nullable();
$table->timestamps(); --}}

<x-app-layout>
    <div class="py-12">
        <div class="max-w-full px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold leading-tight">Cotizaciones</h2>
                        <x-link-button :href="route('cotizaciones.create')">
                            Nueva cotización
                        </x-link-button>
                    </div>
                    <div class=" overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-slate-800">
                            <thead class="bg-gray-200 dark:bg-slate-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Producto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Cliente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Fecha de cotización</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Vigencia</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Comentarios</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100 dark:bg-slate-900/50 divide-y divide-gray-200 dark:divide-slate-700">
                                @foreach ($cotizaciones as $cotizacion)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a class="text-blue-600 hover:text-blue-700" href="{{ route('cotizaciones.detail', $cotizacion->id) }}">Ir a detalle</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $cotizacion->cliente->nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $cotizacion->fecha_cot }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $cotizacion->vigencia }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $cotizacion->comentarios }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('cotizaciones.show', $cotizacion->id) }}">Ver</a>
                                            <a class="text-yellow-600 hover:text-yellow-900 ml-4" href="{{ route('cotizaciones.edit', $cotizacion->id) }}">Editar</a>
                                            <form method="POST" class="inline" action="{{ route('cotizaciones.destroy', $cotizacion->id) }}">
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
