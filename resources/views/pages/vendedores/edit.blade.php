<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight mb-4">Editar Vendedor</h2>
                    <form method="POST" action="{{ route('vendedores.update', $vendedor->id) }}" novalidate>
                        @csrf
                        @method('PUT')
                    
                        <div class="mb-4">
                            <x-input-label for="nombre" :value="__('Nombre')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre', $vendedor->user->name)"  autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>
                    
                        <div class="mb-4">
                            <x-input-label for="correo" :value="__('Correo')" />
                            <x-text-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="old('correo', $vendedor->user->email)" />
                            <x-input-error :messages="$errors->get('correo')" class="mt-2" />
                        </div>
                    
                        <div class="mb-4">
                            <x-input-label for="telefono" :value="__('Teléfono')" />
                            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono', $vendedor->telefono)" />
                            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                        </div>
                    
                        <div class="mb-4">
                            <x-input-label for="password" :value="__('Contraseña')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    
                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Actualizar vendedor') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>