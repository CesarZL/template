<div>
    <!-- Fondo de la barra lateral (solo móvil) -->
    <div
        class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'"
        aria-hidden="true"
        x-cloak
    ></div>

    <!-- Barra lateral -->
    <div
        id="sidebar"
        class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-slate-800 p-4 transition-all duration-200 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
        @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false"
        x-cloak="lg"
    >

        <!-- Encabezado de la barra lateral -->
        <div class="flex justify-between mb-3 pr-3 sm:px-2">
            <!-- Botón de cierre -->
            <button class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Cerrar barra lateral</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>
            </button>
           
        </div>

        <!-- Enlaces -->
        <div class="space-y-8">
            <!-- Grupo de páginas -->
            <div>
                <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
                    <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Páginas</span>
                </h3>
                <ul class="mt-3">
                    <!-- Panel de control -->
                    <li class="hover:bg-slate-700 hover:cursor-pointer px-1 py-2 rounded-md mb-0.5 last:mb-0 transition duration-200 @if(in_array(Request::segment(1), ['dashboard'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['dashboard'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('dashboard') }}">
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Panel de control</span>
                        </a>
                    </li>
                    
                    <!-- Productos -->
                    <li class="hover:bg-slate-700 hover:cursor-pointer px-1 py-2 rounded-md mb-0.5 last:mb-0 transition duration-200 @if(in_array(Request::segment(1), ['productos'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['productos'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('productos.index') }}">
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Productos</span>
                        </a>
                    </li>

                    <!-- Categorías -->
                    <li class="hover:bg-slate-700 hover:cursor-pointer px-1 py-2 rounded-md mb-0.5 last:mb-0 transition duration-200 @if(in_array(Request::segment(1), ['categorias'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['categorias'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('categorias.index') }}">
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Categorías</span>
                        </a>
                    </li>

                    <!-- Inventarios -->
                    <li class="hover:bg-slate-700 hover:cursor-pointer px-1 py-2 rounded-md mb-0.5 last:mb-0 transition duration-200 @if(in_array(Request::segment(1), ['inventarios'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['inventarios'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('inventarios.index') }}">
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Inventarios</span>
                        </a>
                    </li>

                    <!-- Clientes -->
                    <li class="hover:bg-slate-700 hover:cursor-pointer px-1 py-2 rounded-md mb-0.5 last:mb-0 transition duration-200 @if(in_array(Request::segment(1), ['clientes'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['clientes'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('clientes.index') }}">
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Clientes</span>
                        </a>
                    </li>

                    <!-- Proveedores -->
                    <li class="hover:bg-slate-700 hover:cursor-pointer px-1 py-2 rounded-md mb-0.5 last:mb-0 transition duration-200 @if(in_array(Request::segment(1), ['proveedores'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['proveedores'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('proveedores.index') }}">
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Proveedores</span>
                        </a>
                    </li>

                    <!-- Forma de pago -->
                    <li class="hover:bg-slate-700 hover:cursor-pointer px-1 py-2 rounded-md mb-0.5 last:mb-0 transition duration-200 @if(in_array(Request::segment(1), ['forma-pago'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['forma-pago'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('forma-pago.index') }}">
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Formas de pago</span>
                        </a>
                    </li>

                    <!-- Compras -->
                    <li class="hover:bg-slate-700 hover:cursor-pointer px-1 py-2 rounded-md mb-0.5 last:mb-0 transition duration-200 @if(in_array(Request::segment(1), ['compras'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['compras'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('compras.index') }}">
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Compras</span>
                        </a>
                    </li>

                    <!-- Cotizaciones -->
                    <li class="hover:bg-slate-700 hover:cursor-pointer px-1 py-2 rounded-md mb-0.5 last:mb-0 transition duration-200 @if(in_array(Request::segment(1), ['cotizaciones'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['cotizaciones'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('cotizaciones.index') }}">
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cotizaciones</span>
                        </a>
                    </li>

                    <!-- Vendedores -->
                    <li class="hover:bg-slate-700 hover:cursor-pointer px-1 py-2 rounded-md mb-0.5 last:mb-0 transition duration-200 @if(in_array(Request::segment(1), ['vendedores'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['vendedores'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('vendedores.index') }}">
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Vendedores</span>
                        </a>
                    </li>

                    <!-- Ventas -->
                    <li class="hover:bg-slate-700 hover:cursor-pointer px-1 py-2 rounded-md mb-0.5 last:mb-0 transition duration-200 @if(in_array(Request::segment(1), ['ventas'])){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if(in_array(Request::segment(1), ['ventas'])){{ 'hover:text-slate-200' }}@endif" href="{{ route('ventas.index') }}">
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Ventas</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Botón para expandir / colapsar -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
            <div class="px-3 py-2">
                <button @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expandir / colapsar barra lateral</span>
                    <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
                        <path class="text-slate-400" d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
                        <path class="text-slate-600" d="M3 23H1V1h2z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>
