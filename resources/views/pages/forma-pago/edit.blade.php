<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight mb-4">Editar forma de pago</h2>
                    <form method="POST" action="{{ route('forma-pago.update', $formaPago->id) }}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <x-input-label for="tipo" :value="__('Tipo')" />
                            <x-text-input id="tipo" class="block mt-1 w-full" type="text" name="tipo" :value="old('tipo', $formaPago->tipo)" />
                            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                        </div>
                       
                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Editar forma de pago') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>