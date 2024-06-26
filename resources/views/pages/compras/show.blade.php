<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight mb-4">
                        Ver compra
                    </h2>
                    
                    <div class="mb-4">
                        <x-input-label for="proveedor_id" :value="__('Proveedor')" />
                        <x-select-input id="proveedor_id" class="block mt-1 w-full" name="proveedor_id" :value="old('proveedor_id')" disabled>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}" {{ $compra->proveedor_id == $proveedor->id ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('proveedor_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="producto_id" :value="__('Producto')" />
                        <x-select-input id="producto_id" class="block mt-1 w-full" name="producto_id" :value="old('producto_id')" disabled>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}" {{ $compra->producto_id == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('producto_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="cantidad" :value="__('Cantidad')" />
                        <x-text-input id="cantidad" class="block mt-1 w-full" type="number" step="1" name="cantidad" :value="old('cantidad', $compra->cantidad)"  disabled />
                        <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="precio" :value="__('Precio')" />
                        <x-text-input id="precio" class="block mt-1 w-full" type="number" step="1" name="precio" :value="old('precio', $compra->precio)"  disabled />
                        <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="fecha_compra" :value="__('Fecha de Compra')" />
                        <x-date-input id="fecha_compra" class="block mt-1 w-full" name="fecha_compra" :value="old('fecha_compra', $compra->fecha_compra)" disabled />
                        <x-input-error :messages="$errors->get('fecha_compra')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="descuento" :value="__('Descuento')" />
                        <x-text-input id="descuento" class="block mt-1 w-full" type="number" step="0.01" name="descuento" :value="old('descuento', $compra->descuento)"  disabled />
                        <x-input-error :messages="$errors->get('descuento')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="total" :value="__('Total')" />
                        <x-text-input id="total" class="block mt-1 w-full" type="number" step="1" name="total" :value="old('total', $compra->total)"  disabled />
                        <x-input-error :messages="$errors->get('total')" class="mt-2" />
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>