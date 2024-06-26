<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight mb-4">
                        Ver entrada de inventario
                    </h2>
                    <div class="mb-4">
                        <x-input-label for="producto_id" :value="__('Producto')" />
                        <x-select-input id="producto_id" class="block mt-1 w-full" name="producto_id" :value="old('producto_id')" disabled>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}" {{ $inventario->producto_id == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('producto_id')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="fecha_entrada" :value="__('Fecha de Entrada')" />
                        <x-date-input id="fecha_entrada" class="block mt-1 w-full" name="fecha_entrada" :value="old('fecha_entrada', $inventario->fecha_entrada)" disabled />
                        <x-input-error :messages="$errors->get('fecha_entrada')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="fecha_salida" :value="__('Fecha de Salida')" />
                        <x-date-input id="fecha_salida" class="block mt-1 w-full" name="fecha_salida" :value="old('fecha_salida', $inventario->fecha_salida)" disabled />
                        <x-input-error :messages="$errors->get('fecha_salida')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="movimiento" :value="__('Movimiento')" />
                        <x-select-input id="movimiento" class="block mt-1 w-full" name="movimiento" :value="old('movimiento')" disabled>
                            <option value="" disabled selected>{{ __('Selecciona un movimiento') }}</option>
                            <option value="Entrada" {{ $inventario->movimiento == 'Entrada' ? 'selected' : '' }}>Entrada</option>
                            <option value="Salida" {{ $inventario->movimiento == 'Salida' ? 'selected' : '' }}>Salida</option>
                        </x-select-input>
                        <x-input-error :messages="$errors->get('movimiento')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="motivo" :value="__('Motivo')" />
                        <x-text-input id="motivo" class="block mt-1 w-full" type="text" name="motivo" :value="old('motivo', $inventario->motivo)"  disabled />
                        <x-input-error :messages="$errors->get('motivo')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="cantidad" :value="__('Cantidad')" />
                        <x-text-input id="cantidad" class="block mt-1 w-full" type="number" step="1" name="cantidad" :value="old('cantidad', $inventario->cantidad)"  disabled />
                        <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>