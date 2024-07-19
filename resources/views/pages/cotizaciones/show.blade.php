<x-app-layout>
  <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow-sm my-6" id="invoice">
      <!-- Información de la cotización -->
      <div class="grid grid-cols-2 items-center">
          <div>
                <p class="font-bold text-gray-800">Cotización para:	</p>
                {{-- <p class="text-gray-500">{{ $cotizacion->cliente->nombre }}</p>
                <p class="text-gray-500">{{ $cotizacion->cliente->telefono }}</p>
                <p class="text-gray-500">{{ $cotizacion->cliente->correo }}</p> --}}
                <p class="text-gray-800">Cliente:  <span class="text-gray-500">{{ $cotizacion->cliente->nombre }}</span></p>
                <p class="text-gray-800">Teléfono:  <span class="text-gray-500">{{ $cotizacion->cliente->telefono }}</span></p>
                <p class="text-gray-800">Email:  <span class="text-gray-500">{{ $cotizacion->cliente->correo }}</span></p>

          </div>

          <div class="text-right">
                <p class="text-gray-800">Cotización número: <span class="text-gray-500">{{ $cotizacion->id }}</span></p>
                <p class="text-gray-800">Fecha de cotización: <span class="text-gray-500">{{ $cotizacion->fecha_cot }}</span></p>
                <p class="text-gray-800">Fecha de expiración: <span class="text-gray-500">{{ $cotizacion->vigencia }}</span></p>
          </div>
      </div>

      <!-- Comentarios -->
      <div class="items-center mt-3">
        <div>
            <p class="font-bold text-gray-800">
                Comentarios:
            </p>
            <p class="text-gray-500">
                {{ $cotizacion->comentarios }}
            </p>
        </div>
    </div>

      <!-- Items -->
      <div class="-mx-4 mt-8 flow-root sm:mx-0">
          <table class="min-w-full">
              <colgroup>
                  <col class="w-full sm:w-1/2">
                  <col class="sm:w-1/6">
                  <col class="sm:w-1/6">
                  <col class="sm:w-1/6">
              </colgroup>
              <thead class="border-b border-gray-300 text-gray-900">
                  <tr>
                      <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Items</th>
                      <th scope="col" class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">Cantidad</th>
                      <th scope="col" class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">Precio</th>
                      <th scope="col" class="py-3.5 pl-3 pr-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">Total</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($cotizacion->productos as $producto)
                      <tr class="border-b border-gray-200">
                          <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                              <div class="font-medium text-gray-900">{{ $producto->nombre }}</div>
                              <div class="mt-1 truncate text-gray-500">{{ $producto->descripcion }}</div>
                          </td>
                          <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">{{ $producto->pivot->cantidad }}</td>
                          <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">${{ $producto->precio_venta }}</td>
                          <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">${{ number_format($producto->pivot->cantidad * $producto->precio_venta, 2) }}</td>
                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
                <tr>
                    <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-6 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">Subtotal (antes de IVA)</th>
                    <th scope="row" class="pl-6 pr-3 pt-6 text-left text-sm font-normal text-gray-500 sm:hidden">Subtotal (antes de IVA)</th>
                    <td class="pl-3 pr-6 pt-6 text-right text-sm text-gray-500 sm:pr-0">${{ number_format($iva, 2) }}</td>
                </tr>
                <tr>
                    <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-4 text-right text-sm font-normal text-gray-500 sm:table-cell sm:pl-0">IVA (16%)</th>
                    <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-normal text-gray-500 sm:hidden">IVA (16%)</th>
                    <td class="pl-3 pr-6 pt-4 text-right text-sm text-gray-500 sm:pr-0">${{ number_format($subtotal, 2) }}</td>
                </tr>
                <tr>
                    <th scope="row" colspan="3" class="hidden pl-4 pr-3 pt-4 text-right text-sm font-semibold text-gray-900 sm:table-cell sm:pl-0">Total (con IVA)</th>
                    <th scope="row" class="pl-6 pr-3 pt-4 text-left text-sm font-semibold text-gray-900 sm:hidden">Total (con IVA)</th>
                    <td class="pl-3 pr-4 pt-4 text-right text-sm font-semibold text-gray-900 sm:pr-0">${{ number_format($total, 2) }}</td>
                </tr>
                
                
              </tfoot>
          </table>
      </div>

      <!-- Footer -->
      <div class="border-t-2 pt-4 text-xs text-gray-500 text-center mt-16">
          La cotización es válida por {{ $diasVigencia }} días. Por favor, póngase en contacto con nosotros para confirmar su pedido.
      </div>
  </div>
</x-app-layout>
