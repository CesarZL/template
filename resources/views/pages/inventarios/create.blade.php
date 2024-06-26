<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight mb-4">Registrar Entrada de Inventario</h2>
                    <form method="POST" action="{{ route('inventarios.store') }}" novalidate>
                        @csrf

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

                        {{-- <div class="mb-4">
                            <x-input-label for="fecha" :value="__('Fecha')" />
                            <x-datepicker id="fecha" class="block w-full" name="fecha" :value="old('fecha')"  />
                        </div> --}}

                        <div class="mb-4">
                            <x-input-label for="motivo" :value="__('Motivo')" />
                            <x-text-input id="motivo" class="block mt-1 w-full" type="text" name="motivo" :value="old('motivo')"  />
                            <x-input-error :messages="$errors->get('motivo')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="cantidad" :value="__('Cantidad')" />
                            <x-text-input id="cantidad" class="block mt-1 w-full" type="number" step="1" name="cantidad" :value="old('cantidad')"  />
                            <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
                        </div>
                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Registrar Entrada') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>