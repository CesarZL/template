<x-app-layout>
    <div class="py-12">
        <div class="max-w-full px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold leading-tight">Clientes</h2>
                        <x-link-button :href="route('clientes.create')">
                            Nuevo Cliente
                        </x-link-button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-slate-800">
                            <thead class="bg-gray-200 dark:bg-slate-700">
                                <tr>
                                    <th class="w-1/3 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Nombre</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Correo</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Telefono</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Direccion</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">RFC</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Razon Social</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">CP</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Regimen Fiscal</th>
                                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100 dark:bg-slate-900/50 divide-y divide-gray-200 dark:divide-slate-700">
                                @foreach ($clientes as $cliente)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->correo }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->telefono }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->direccion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->rfc }}</td> 
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->razon_social }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->cp }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->regimen_fiscal }}</td> 
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('clientes.show', $cliente->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="text-yellow-600 hover:text-yellow-900 ml-4">Editar</a>
                                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
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