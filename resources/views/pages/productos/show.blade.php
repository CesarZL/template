<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight mb-4">Ver Producto</h2>
                    <div class="mb-4">
                        <x-input-label for="nombre" :value="__('Nombre')" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="$producto->nombre"  disabled />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="categoria_id" :value="__('Categoría')" />
                        <x-select-input id="categoria_id" class="block mt-1 w-full" name="categoria_id" disabled>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                            @endforeach
                        </x-select-input>                        
                    </div>
                    <div class="mb-4">
                        <x-input-label for="precio_venta" :value="__('Precio de Venta')" />
                        <x-text-input id="precio_venta" class="block mt-1 w-full" type="number" name="precio_venta" :value=" $producto->precio_venta"  disabled />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="precio_compra" :value="__('Precio de Compra')" />
                        <x-text-input id="precio_compra" class="block mt-1 w-full" type="number" name="precio_compra" :value="$producto->precio_compra"  disabled />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="color" :value="__('Color')" />
                        <x-text-input id="color" class="block mt-1 w-full" type="text" name="color" :value="$producto->color"  disabled />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="descripcion_corta" :value="__('Descripción corta')" />
                        <x-textarea-input id="descripcion_corta" class="block mt-1 w-full" name="descripcion_corta" :value="$producto->descripcion_corta" disabled />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="descripcion_larga" :value="__('Descripción larga')" />
                        <x-textarea-input id="descripcion_larga" class="block mt-1 w-full" name="descripcion_larga" :value="$producto->descripcion_larga" disabled />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>