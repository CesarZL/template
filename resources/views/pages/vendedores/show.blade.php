<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight mb-4">Ver vendedor</h2>
                    <div class="mb-4">
                        <x-input-label for="nombre" :value="__('Nombre')" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="$vendedor->user->name"  disabled />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="correo" :value="__('Correo')" />
                        <x-text-input id="correo" class="block mt-1 w-full" type="email" name="correo" :value="$vendedor->user->email" disabled/>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="telefono" :value="__('Teléfono')" />
                        <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="$vendedor->telefono" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>