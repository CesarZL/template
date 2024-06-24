<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight mb-4">Editar cliente</h2>
                    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <x-input-label for="nombre" :value="__('Nombre')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre', $cliente->nombre)" />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="correo" :value="__('Correo')" />
                            <x-text-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="old('correo', $cliente->correo)" />
                            <x-input-error :messages="$errors->get('correo')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="telefono" :value="__('Teléfono')" />
                            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono', $cliente->telefono)" />
                            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="direccion" :value="__('Dirección')" />
                            <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion', $cliente->direccion)" />
                            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="rfc" :value="__('RFC')" />
                            <x-text-input id="rfc" class="block mt-1 w-full" type="text" name="rfc" :value="old('rfc', $cliente->rfc)" />
                            <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="razon_social" :value="__('Razón Social')" />
                            <x-text-input id="razon_social" class="block mt-1 w-full" type="text" name="razon_social" :value="old('razon_social', $cliente->razon_social)" />
                            <x-input-error :messages="$errors->get('razon_social')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="cp" :value="__('Código Postal')" />
                            <x-text-input id="cp" class="block mt-1 w-full" type="text" name="cp" :value="old('cp', $cliente->cp)" />
                            <x-input-error :messages="$errors->get('cp')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="regimen_fiscal" :value="__('Régimen Fiscal')" />
                            <x-text-input id="regimen_fiscal" class="block mt-1 w-full" type="text" name="regimen_fiscal" :value="old('regimen_fiscal', $cliente->regimen_fiscal)" />
                            <x-input-error :messages="$errors->get('regimen_fiscal')" class="mt-2" />
                        </div>
                        
                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Editar cliente') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>