<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight mb-4">Registrar cotización</h2>
                    <form method="POST" action="{{ route('cotizaciones.store') }}" novalidate>
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="cliente_id" :value="__('Cliente')" />
                            <x-select-input id="cliente_id" class="block mt-1 w-full" name="cliente_id" :value="old('cliente_id')">
                                <option value="" disabled selected>{{ __('Selecciona un cliente') }}</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('cliente_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="vigencia" :value="__('Vigencia')" />
                            <x-datepicker-no-limit id="vigencia" class="block w-full" name="vigencia" :value="old('vigencia')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="comentarios" :value="__('Comentarios')" />
                            <x-text-input id="comentarios" class="block mt-1 w-full" type="text" name="comentarios" :value="old('comentarios')" autofocus />
                            <x-input-error :messages="$errors->get('comentarios')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="productos" :value="__('Productos')" />
                            @foreach ($productos as $producto)
                                <div class="flex items-center mb-2">
                                    <input type="checkbox" id="producto_{{ $producto->id }}" name="productos[]" value="{{ $producto->id }}" class="hidden peer"
                                           {{ in_array($producto->id, old('productos', [])) ? 'checked' : '' }}>
                                    <label for="producto_{{ $producto->id }}" class="inline-flex items-center justify-between w-2/3 py-2 px-3 cursor-pointer form-input peer-checked:border-indigo-500 dark:peer-checked:text-gray-300 peer-checked:text-gray-600">
                                        <span>{{ $producto->nombre }}</span>
                                    </label>
                                    <input id="cantidad_{{ $producto->id }}" class="ml-4 w-1/3 form-input" type="number" name="cantidades[{{ $producto->id }}]" 
                                           value="{{ old('cantidades.'.$producto->id, '') }}" placeholder="{{ __('Cantidad') }}" />
                                </div>
                            @endforeach
                            <x-input-error :messages="$errors->get('productos')" class="mt-2" />
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
