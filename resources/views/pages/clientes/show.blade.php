<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight mb-4">
                        Ver cliente
                    </h2>
                    <div class="mb-4">
                        <x-input-label for="nombre" :value="__('Nombre')" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="$cliente->nombre" disabled />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="correo" :value="__('Correo')" />
                        <x-text-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="$cliente->correo" disabled />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="telefono" :value="__('Teléfono')" />
                        <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="$cliente->telefono" disabled />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="direccion" :value="__('Dirección')" />
                        <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="$cliente->direccion" disabled />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="rfc" :value="__('RFC')" />
                        <x-text-input id="rfc" class="block mt-1 w-full" type="text" name="rfc" :value="$cliente->rfc" disabled />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="razon_social" :value="__('Razón Social')" />
                        <x-text-input id="razon_social" class="block mt-1 w-full" type="text" name="razon_social" :value="$cliente->razon_social" disabled />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="cp" :value="__('Código Postal')" />
                        <x-text-input id="cp" class="block mt-1 w-full" type="text" name="cp" :value="$cliente->cp" disabled />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="regimen_fiscal" :value="__('Régimen Fiscal')" />
                        <x-text-input id="regimen_fiscal" class="block mt-1 w-full" type="text" name="regimen_fiscal" :value="$cliente->regimen_fiscal" disabled />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>