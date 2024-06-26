{{-- $table->string('nombre');
$table->string('nombre_contacto');
$table->string('correo');
$table->string('telefono');
$table->timestamps(); --}}


<x-app-layout>
    <div class="py-12">
        <div class="max-w-full px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold leading-tight">Proveedores</h2>
                        <x-link-button :href="route('proveedores.create')">
                            Nuevo proveedor
                        </x-link-button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-slate-800">
                            <thead class="bg-gray-200 dark:bg-slate-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Nombre de contacto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Correo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Telefono</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100 dark:bg-slate-900/50 divide-y divide-gray-200 dark:divide-slate-700">
                                @foreach ($proveedores as $proveedor)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $proveedor->nombre}}
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $proveedor->nombre_contacto }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $proveedor->correo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $proveedor->telefono }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('proveedores.show', $proveedor->id) }}">Ver</a>
                                            <a class="text-yellow-600 hover:text-yellow-900 ml-4" href="{{ route('proveedores.edit', $proveedor->id) }}">Editar</a>
                                            <form method="POST" class="inline" action="{{ route('proveedores.destroy', $proveedor->id) }}">
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