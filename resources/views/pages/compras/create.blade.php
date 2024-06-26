{{-- 
$table->foreignId('proveedor_id')->constrained('proveedores')->onDelete('cascade'); // Nombre explícito de la tabla
$table->foreignId('producto_id')->constrained()->onDelete('cascade');
$table->integer('cantidad');
$table->decimal('precio', 8, 2);
$table->date('fecha_compra');
$table->decimal('descuento', 8, 2)->nullable();
$table->timestamps(); --}}


<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight mb-4">Registrar compra</h2>
                    <form method="POST" action="{{ route('compras.store') }}" novalidate>
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="proveedor_id" :value="__('Proveedor')" />
                            <x-select-input id="proveedor_id" class="block mt-1 w-full" name="proveedor_id" :value="old('proveedor_id')" >
                                <option value="" disabled selected>{{ __('Selecciona un proveedor') }}</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('proveedor_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="producto_id" :value="__('Producto')" />
                            <x-select-input id="producto_id" class="block mt-1 w-full" name="producto_id" :value="old('producto_id')" >
                                <option value="" disabled selected>{{ __('Selecciona un producto') }}</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('producto_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="cantidad" :value="__('Cantidad')" />
                            <x-text-input id="cantidad" class="block mt-1 w-full" type="number" step="1" name="cantidad" :value="old('cantidad')"  />
                            <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="precio" :value="__('precio')" />
                            <x-text-input id="precio" class="block mt-1 w-full" type="number" step="1" name="precio" :value="old('precio')"  />
                            <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="fecha_compra" :value="__('Fecha de compra')" />
                            <x-datepicker id="fecha_compra" class="block w-full" name="fecha_compra" :value="old('fecha_compra')"  />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="descuento" :value="__('Porcentaje de descuento')" />
                            <x-text-input id="descuento" class="block mt-1 w-full" type="number" step="0.01" name="descuento" :value="old('descuento')"  />
                            <x-input-error :messages="$errors->get('descuento')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Registrar Compra') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>