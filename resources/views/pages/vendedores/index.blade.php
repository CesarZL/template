{{-- $table->string('telefono');
$table->string('curp');
$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
$table->timestamps(); --}}


<x-app-layout>
    <div class="py-12">
        <div class="max-w-full px-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold leading-tight">Vendedores</h2>
                        <x-link-button :href="route('vendedores.create')">
                            Nuevo vendedor
                        </x-link-button>
                    </div>
                    <div class=" overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-slate-800">
                            <thead class="bg-gray-200 dark:bg-slate-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Telefono</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">CURP</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Usuario</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Fecha de creación</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100 dark:bg-slate-900/50 divide-y divide-gray-200 dark:divide-slate-700">
                                
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Teléfono</td>
                                    <td class="px-6 py-4 whitespace-nowrap">CURP</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Usuario</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Fecha de creación</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="" class="text-blue-600 hover:text-blue-900">Ver</a>
                                        <a href="" class="text-yellow-600 hover:text-yellow-900 ml-4">Editar</a>
                                        <form action="" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>