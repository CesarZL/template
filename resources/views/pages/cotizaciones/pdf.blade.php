<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
    <style>
        body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .invoice-container {
                max-width: 800px;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .info-section {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .info-client, .info-details {
                width: 48%;
            }

            .info-label {
                font-weight: bold;
                color: #333;
            }

            .info-text {
                color: #666;
            }

            .comments-section {
                margin-bottom: 20px;
            }

            .section-title {
                font-weight: bold;
                color: #333;
                margin-bottom: 10px;
            }

            .comments-text {
                color: #666;
            }

            .items-section {
                margin-bottom: 20px;
            }

            .items-table {
                width: 100%;
                border-collapse: collapse;
            }

            .items-table th, .items-table td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: left;
            }

            .items-table th {
                background-color: #f4f4f4;
                font-weight: bold;
            }

            .item-name {
                font-weight: bold;
                color: #333;
            }

            .item-description {
                color: #666;
                font-size: 0.875rem;
            }

            .footer {
                border-top: 2px solid #ddd;
                padding-top: 10px;
                font-size: 0.875rem;
                color: #666;
                text-align: center;
            }
        </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Información de la cotización -->
        <div class="info-section">
            <div class="info-client">
                <p class="info-label">Cliente:</p>
                <p class="info-text">{{ $cotizacion->cliente->nombre }}</p>
                <p class="info-text">{{ $cotizacion->cliente->telefono }}</p>
                <p class="info-text">{{ $cotizacion->cliente->correo }}</p>
            </div>

            <div class="info-details">
                <p class="info-label">Cotización número: <span class="info-text">{{ $cotizacion->id }}</span></p>
                <p class="info-label">Fecha de cotización: <span class="info-text">{{ $cotizacion->fecha_cot }}</span></p>
                <p class="info-label">Fecha de expiración: <span class="info-text">{{ $cotizacion->vigencia }}</span></p>
            </div>
        </div>

        <!-- Comentarios -->
        <div class="comments-section">
            <p class="section-title">Comentarios:</p>
            <p class="comments-text">{{ $cotizacion->comentarios }}</p>
        </div>

        <!-- Items -->
        <div class="items-section">
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cotizacion->productos as $producto)
                        <tr>
                            <td class="item-name">
                                <div>{{ $producto->nombre }}</div>
                                <div class="item-description">{{ $producto->descripcion }}</div>
                            </td>
                            <td>{{ $producto->pivot->cantidad }}</td>
                            <td>${{ $producto->precio_venta }}</td>
                            <td>${{ number_format($producto->pivot->cantidad * $producto->precio_venta, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Subtotal (antes de IVA)</th>
                        <td>${{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <th colspan="3">IVA (16%)</th>
                        <td>${{ number_format($iva, 2) }}</td>
                    </tr>
                    <tr>
                        <th colspan="3">Total (con IVA)</th>
                        <td>${{ number_format($total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            La cotización es válida por {{ $diasVigencia }} días. Por favor, póngase en contacto con nosotros para confirmar su pedido.
        </div>
    </div>
</body>
</html>
