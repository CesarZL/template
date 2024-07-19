<x-app-layout>
    <!-- component -->
    <div class="p-5 max-h-screen">
        <div class="flex lg:flex-row flex-col-reverse bg-white dark:bg-slate-800 sm:rounded-lg">
            <!-- left section -->
            <div class="w-full lg:w-3/5 sm:rounded-lg bg-gray-50 dark:bg-gray-700">
                
                <!-- header -->
                <div class="flex flex-row justify-between items-center px-5 mt-5">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" placeholder="Buscar productos..." />
                    </div>
                </div>

                {{-- <!-- categories -->
                <div class="py-5 flex flex-row px-5 overflow-x-auto whitespace-nowrap flex-nowrap">
                    <span class="px-5 py-1 bg-indigo-500 font-semibold rounded-2xl text-white text-sm mr-4 hover:bg-gray-200 dark:hover:bg-slate-600 hover:text-indigo-500 dark:hover:text-gray-200 cursor-pointer">
                        Todo
                    </span>
                    <span class="px-5 py-1 rounded-2xl text-sm font-semibold mr-4 bg-indigo-100 hover:bg-gray-200 dark:hover:bg-slate-600 text-indigo-500 dark:hover:text-gray-200 cursor-pointer">
                        Categoría 1 
                    </span> 
                    <span class="px-5 py-1 rounded-2xl text-sm font-semibold mr-4 bg-indigo-100 hover:bg-gray-200 dark:hover:bg-slate-600 text-indigo-500 dark:hover:text-gray-200 cursor-pointer">
                        Categoría 2 
                    </span> 
                    <span class="px-5 py-1 rounded-2xl text-sm font-semibold mr-4 bg-indigo-100 hover:bg-gray-200 dark:hover:bg-slate-600 text-indigo-500 dark:hover:text-gray-200 cursor-pointer">
                        Categoría 3 
                    </span> 
                    <span class="px-5 py-1 rounded-2xl text-sm font-semibold mr-4 bg-indigo-100 hover:bg-gray-200 dark:hover:bg-slate-600 text-indigo-500 dark:hover:text-gray-200 cursor-pointer">
                        Categoría 3 
                    </span> 
                    <span class="px-5 py-1 rounded-2xl text-sm font-semibold mr-4 bg-indigo-100 hover:bg-gray-200 dark:hover:bg-slate-600 text-indigo-500 dark:hover:text-gray-200 cursor-pointer">
                        Categoría 3 
                    </span> 
                    <span class="px-5 py-1 rounded-2xl text-sm font-semibold mr-4 bg-indigo-100 hover:bg-gray-200 dark:hover:bg-slate-600 text-indigo-500 dark:hover:text-gray-200 cursor-pointer">
                        Categoría 3 
                    </span> 
                    <span class="px-5 py-1 rounded-2xl text-sm font-semibold mr-4 bg-indigo-100 hover:bg-gray-200 dark:hover:bg-slate-600 text-indigo-500 dark:hover:text-gray-200 cursor-pointer">
                        Categoría 3
                    </span>
                </div> --}}

                <!-- products en grid con scroll -->
                <div class="px-5 my-5 max-h-[80vh] overflow-y-auto">
                    <div class="grid grid-cols-3 gap-4">
                        @for ($i = 0; $i < 50; $i++)
                        <div class="px-3 py-3 flex flex-col rounded-md h-32 justify-between bg-white border border-gray-300 dark:border-gray-500 dark:bg-slate-800 hover:border hover:border-indigo-500 transition duration-300 cursor-pointer">
                            <div>
                                <div class="font-bold text-indigo-500 dark:text-gray-100">Producto {{ $i + 1 }}</div>
                                <span class="font-light text-sm text-gray-400">Categoría {{ $i + 1 }}</span>
                            </div>
                            <div class="flex flex-row justify-between items-center">
                                <span class="self-end font-bold text-lg text-indigo-500">$1.75</span>
                                <img src="https://picsum.photos/600/600" class="h-14 w-14 object-cover rounded-md" alt="">
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

            </div>

            <!-- right section -->
            <div class="w-full lg:w-2/5">

                <!-- header -->
                <div class="flex flex-row items-center justify-between px-5 mt-5">
                    <div class="font-bold text-xl">Orden actual</div>
                    <div class="font-semibold">
                        <span class="px-4 py-2 rounded-md bg-red-100 text-red-500 hover:bg-red-500 hover:text-white cursor-pointer transition duration-300">
                            Cancelar
                        </span>
                    </div>
                </div>

                <!-- order list -->
                <div class="mx-5 px-5 py-4 mt-5 overflow-y-auto h-56 border border-slate-600 rounded-md space-y-3">
                    @for ($i = 0; $i < 2; $i++)
                    <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center w-2/5">
                            <img src="https://picsum.photos/600/600"
                                class="w-10 h-10 object-cover rounded-md" alt="">
                            <span class="ml-4 font-semibold text-sm">Producto {{ $i + 1 }}</span>
                        </div>
                        <div class="w-32 flex justify-between items-center">
                            <span class="px-3 py-1 rounded-md bg-gray-100 dark:bg-slate-700 text-gray-800 dark:text-gray-200 hover:bg-red-100 hover:text-red-500 cursor-pointer transition duration-300">-</span>
                            <input type="number" class="form-input w-12 text-center appearance-none" value="1" style="text-align: center; -moz-appearance: textfield;">
                            <span class="px-3 py-1 rounded-md bg-gray-100    dark:bg-slate-700 text-gray-800 dark:text-gray-200 hover:bg-green-100 hover:text-green-500 cursor-pointer transition duration-300">+</span>
                        </div>                        
                        <div class="font-semibold text-lg w-16 text-center">
                            $13.50
                        </div>
                    </div> 
                    @endfor
                </div>

                <!-- totalItems -->
                <div class="px-5 mt-5">
                    <div class="py-4 rounded-md shadow-lg border border-slate-600">
                        <div class=" px-4 flex justify-between ">
                            <span class="font-semibold text-sm">Subtotal</span>
                            <span class="font-bold">$35.25</span>
                        </div>
                        <div class="px-4 flex justify-between ">
                            <span class="font-semibold text-sm">Iva</span>
                            <span class="font-bold">$2.25</span>
                        </div>
                        <div class="px-4 flex items-center justify-between">
                            <span class="font-semibold text-lg">Total</span>
                            <span class="font-bold text-lg">$37.50</span>
                        </div>
                    </div>
                </div>

                <!-- cash -->
                <div class="px-5 mt-5">
                    <div class="rounded-md shadow-lg px-4 py-6 border border-slate-600 ">
                        <x-input-label for="pago_id" class="uppercase text-xs font-semibold" :value="__('Forma de pago')" />
                        <select class="form-select w-full dark:bg-[#0f172a]/30 " name="pago_id" id="pago_id">
                            <option value="" disabled selected>{{ __('Selecciona una forma de pago') }}</option>
                            <option value="1">Efectivo</option>
                            <option value="2">Tarjeta</option>
                            <option value="3">Transferencia</option>
                        </select>
                        <x-input-error :messages="$errors->get('pago_id')" class="mt-2" />

                        <x-input-label for="monto" class="mt-4 uppercase text-xs font-semibold" :value="__('Monto')" />
                        <input type="number" class="form-input w-full dark:bg-[#0f172a]/30 " name="monto" id="monto" placeholder="Ingrese el monto recibido" />
                        <x-input-error :messages="$errors->get('monto')" class="mt-2" />
                    </div>
                </div>
                
                <!-- client -->
                <div class="px-5 mt-5">
                    <div class="rounded-md shadow-lg px-4 py-6 border border-slate-600 ">
                        <x-input-label for="cliente_id" class="uppercase text-xs font-semibold" :value="__('Cliente')" />
                        <select class="form-select w-full dark:bg-[#0f172a]/30 " name="cliente_id" id="cliente_id">
                            <option value="" disabled selected>{{ __('Selecciona un cliente') }}</option>
                            <option value="1">Cliente 1</option>
                            <option value="2">Cliente 2</option>
                            <option value="3">Cliente 3</option>
                        </select>
                        <x-input-error :messages="$errors->get('cliente_id')" class="mt-2" />
                    </div>
                </div>

                <!-- button pay-->
                <div class="px-5 mt-5  mb-5">
                    <div class="px-4 py-4 rounded-md shadow-lg text-center bg-indigo-500 text-white font-semibold hover:bg-indigo-600 cursor-pointer transition duration-300">
                        Pagar
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
