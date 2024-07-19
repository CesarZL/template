<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function reporteVentas()
    {
        // Venta más grande
        $ventaMax = Venta::orderBy('total', 'desc')->first();
        
        // Venta más pequeña
        $ventaMin = Venta::orderBy('total', 'asc')->first();
        
        // Ventas por mes
        $ventasPorMes = Venta::select(
            DB::raw('DATE_FORMAT(fecha_de_venta, "%Y-%m") as mes'),
            DB::raw('SUM(total) as total_ventas')
        )
        ->groupBy('mes')
        ->orderBy('mes', 'desc')
        ->get();
        
        // Mejores ventas del mes actual
        $ventasMesActual = Venta::whereMonth('fecha_de_venta', date('m'))
                                ->whereYear('fecha_de_venta', date('Y'))
                                ->orderBy('total', 'desc')
                                ->take(10)
                                ->get();

        return view('pages/reportes/ventas', [
            'ventaMax' => $ventaMax,
            'ventaMin' => $ventaMin,
            'ventasPorMes' => $ventasPorMes,
            'ventasMesActual' => $ventasMesActual,
        ]);
    }

    public function reporteVentasPorCategoria()
    {
        // Obtener las ventas agrupadas por categoría
        $ventasPorCategoria = Venta::selectRaw('categorias.nombre as categoria, SUM(venta_producto.cantidad * productos.precio_venta) as total_ventas')
            ->join('venta_producto', 'ventas.id', '=', 'venta_producto.venta_id')
            ->join('productos', 'venta_producto.producto_id', '=', 'productos.id')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->groupBy('categorias.nombre')
            ->orderBy('total_ventas', 'desc')
            ->get();

        return view('pages/reportes/ventas-por-categoria', compact('ventasPorCategoria'));
    }

    public function reporteVentasPorCliente()
    {
        // Obtener las ventas agrupadas por cliente
        $ventasPorCliente = Venta::selectRaw('clientes.nombre as cliente, SUM(venta_producto.cantidad * productos.precio_venta) as total_ventas')
            ->join('venta_producto', 'ventas.id', '=', 'venta_producto.venta_id')
            ->join('productos', 'venta_producto.producto_id', '=', 'productos.id')
            ->join('clientes', 'ventas.cliente_id', '=', 'clientes.id')
            ->groupBy('clientes.nombre')
            ->orderBy('total_ventas', 'desc')
            ->get();

        return view('pages/reportes/ventas-por-cliente', compact('ventasPorCliente'));
    }

    public function reporteClientes()
    {
        $lastMonth = now()->subMonth();
        $currentMonth = now()->startOfMonth();
    
        // Cantidad de clientes en el último mes
        $clientesUltimoMes = Cliente::whereBetween('created_at', [$lastMonth, now()])->count();
        
        // Cantidad de clientes en el mes actual
        $clientesMesActual = Cliente::whereBetween('created_at', [$currentMonth, now()])->count();
        
        // Incremento de clientes
        $incrementoClientes = $clientesMesActual - $clientesUltimoMes;
    
        // Clientes que más compran
        $clientesQueMasCompran = Cliente::withCount(['ventas as total_compras' => function ($query) {
            $query->select(DB::raw('SUM(total)'));
        }])->orderBy('total_compras', 'desc')->take(10)->get();
    
        // Cliente que más ha gastado
        $clienteQueMasGasto = Cliente::withSum('ventas as total_gasto', 'total')
                                    ->orderBy('total_gasto', 'desc')
                                    ->first();
    
        // Cliente que más productos ha comprado
        $clienteQueMasProductos = Cliente::withCount(['ventas as total_productos' => function ($query) {
            $query->select(DB::raw('SUM(venta_producto.cantidad)'))
                  ->join('venta_producto', 'ventas.id', '=', 'venta_producto.venta_id');
        }])->orderBy('total_productos', 'desc')->first();
    
        return view('pages.reportes.clientes', [
            'clientesUltimoMes' => $clientesUltimoMes,
            'clientesMesActual' => $clientesMesActual,
            'incrementoClientes' => $incrementoClientes,
            'clientesQueMasCompran' => $clientesQueMasCompran,
            'clienteQueMasGasto' => $clienteQueMasGasto,
            'clienteQueMasProductos' => $clienteQueMasProductos,
        ]);
    }

    public function reporteProveedores()
    {
        $lastMonth = now()->subMonth();
        $currentMonth = now()->startOfMonth();
        
        // Total de compras por proveedor
        $totalComprasPorProveedor = Proveedor::select('nombre')
            ->selectRaw('SUM(compras.precio * compras.cantidad) as total_compras')
            ->join('compras', 'proveedores.id', '=', 'compras.proveedor_id')
            ->groupBy('proveedores.id')
            ->orderBy('total_compras', 'desc')
            ->get();
        
        // Número de compras por proveedor
        $numeroComprasPorProveedor = Proveedor::select('nombre')
            ->selectRaw('COUNT(compras.id) as numero_compras')
            ->join('compras', 'proveedores.id', '=', 'compras.proveedor_id')
            ->groupBy('proveedores.id')
            ->orderBy('numero_compras', 'desc')
            ->get();
        
        // Proveedor con mayor descuento
        $proveedorMayorDescuento = Proveedor::select('nombre')
            ->selectRaw('MAX(compras.descuento) as max_descuento')
            ->join('compras', 'proveedores.id', '=', 'compras.proveedor_id')
            ->groupBy('proveedores.id')
            ->orderBy('max_descuento', 'desc')
            ->first();
        
        // Proveedor con mayor cantidad de productos comprados
        $proveedorMayorCantidadProductos = Proveedor::select('nombre')
            ->selectRaw('SUM(compras.cantidad) as total_cantidad')
            ->join('compras', 'proveedores.id', '=', 'compras.proveedor_id')
            ->groupBy('proveedores.id')
            ->orderBy('total_cantidad', 'desc')
            ->first();
        
        // Proveedores nuevos en el último mes
        $proveedoresNuevosUltimoMes = Proveedor::whereBetween('created_at', [$lastMonth, now()])
            ->count();
        
        // Proveedores activos vs. inactivos
        $proveedoresActivos = Proveedor::whereHas('compras', function ($query) {
            $query->whereBetween('fecha_compra', [now()->subMonths(6), now()]);
        })->count();

        $proveedoresInactivos = Proveedor::whereDoesntHave('compras', function ($query) {
            $query->whereBetween('fecha_compra', [now()->subMonths(6), now()]);
        })->count();

        // Proveedores con compras recientes
        $proveedoresConComprasRecientes = Proveedor::whereHas('compras', function ($query) {
            $query->where('fecha_compra', '>=', now()->subDays(30));
        })->get();

        return view('pages.reportes.proveedores', [
            'totalComprasPorProveedor' => $totalComprasPorProveedor,
            'numeroComprasPorProveedor' => $numeroComprasPorProveedor,
            'proveedorMayorDescuento' => $proveedorMayorDescuento,
            'proveedorMayorCantidadProductos' => $proveedorMayorCantidadProductos,
            'proveedoresNuevosUltimoMes' => $proveedoresNuevosUltimoMes,
            'proveedoresActivos' => $proveedoresActivos,
            'proveedoresInactivos' => $proveedoresInactivos,
            'proveedoresConComprasRecientes' => $proveedoresConComprasRecientes,
        ]);
    }

    public function reporteProductos()
    {
        $productosMasVendidos = Producto::select('productos.nombre', DB::raw('SUM(venta_producto.cantidad) as total_cantidad'))
            ->join('venta_producto', 'productos.id', '=', 'venta_producto.producto_id')
            ->groupBy('productos.id')
            ->orderBy('total_cantidad', 'desc')
            ->limit(10)
            ->get();
    
        $productosMasIngresos = Producto::select('productos.nombre', DB::raw('SUM(venta_producto.cantidad * productos.precio_venta) as total_ingresos'))
            ->join('venta_producto', 'productos.id', '=', 'venta_producto.producto_id')
            ->groupBy('productos.id')
            ->orderBy('total_ingresos', 'desc')
            ->limit(10)
            ->get();
    
        $productosUltimoMes = Producto::select('productos.nombre', DB::raw('SUM(venta_producto.cantidad) as total_cantidad'))
            ->join('venta_producto', 'productos.id', '=', 'venta_producto.producto_id')
            ->join('ventas', 'ventas.id', '=', 'venta_producto.venta_id')
            ->whereMonth('ventas.fecha_de_venta', now()->month)
            ->whereYear('ventas.fecha_de_venta', now()->year)
            ->groupBy('productos.id')
            ->orderBy('total_cantidad', 'desc')
            ->limit(10)
            ->get();
    
        $productosMenosVendidos = Producto::select('productos.nombre', DB::raw('SUM(venta_producto.cantidad) as total_cantidad'))
            ->join('venta_producto', 'productos.id', '=', 'venta_producto.producto_id')
            ->groupBy('productos.id')
            ->orderBy('total_cantidad', 'asc')
            ->limit(10)
            ->get();
    
        return view('pages/reportes/productos', compact(
            'productosMasVendidos',
            'productosMasIngresos',
            'productosUltimoMes',
            'productosMenosVendidos'
        ));
    }

    public function reporteStock()
    {
        // Productos con stock bajo (umbral arbitrario de 10 unidades)
        $productosStockBajo = Producto::select('productos.nombre', DB::raw('SUM(inventarios.cantidad) AS total_stock'))
            ->join('inventarios', 'productos.id', '=', 'inventarios.producto_id')
            ->groupBy('productos.id', 'productos.nombre')
            ->havingRaw('SUM(inventarios.cantidad) < ?', [10])
            ->orderBy('total_stock', 'asc')
            ->get();

        // Productos con stock alto (umbral arbitrario de 100 unidades)
        $productosStockAlto = Producto::select('productos.nombre', DB::raw('SUM(inventarios.cantidad) AS total_stock'))
            ->join('inventarios', 'productos.id', '=', 'inventarios.producto_id')
            ->groupBy('productos.id', 'productos.nombre')
            ->havingRaw('SUM(inventarios.cantidad) >= ?', [100])
            ->orderBy('total_stock', 'desc')
            ->get();

        // Movimientos de inventario más recientes
        $movimientosRecientes = Inventario::select('productos.nombre', 'inventarios.fecha_entrada', 'inventarios.cantidad', 'inventarios.movimiento', 'inventarios.motivo')
            ->join('productos', 'inventarios.producto_id', '=', 'productos.id')
            ->orderBy('inventarios.fecha_entrada', 'desc')
            ->limit(10)
            ->get();

        // Stock de productos por categoría
        $stockPorCategoria = Categoria::select('categorias.nombre as categoria', DB::raw('SUM(inventarios.cantidad) AS total_stock'))
            ->join('productos', 'categorias.id', '=', 'productos.categoria_id')
            ->join('inventarios', 'productos.id', '=', 'inventarios.producto_id')
            ->groupBy('categorias.nombre')
            ->get();

        return view('pages.reportes.stock', compact('productosStockBajo', 'productosStockAlto', 'movimientosRecientes', 'stockPorCategoria'));
    }

    public function reporteCompras()
    {
        // Productos más comprados
        $productosMasComprados = Compra::select('producto_id', DB::raw('SUM(cantidad) as total_comprado'))
            ->groupBy('producto_id')
            ->orderBy('total_comprado', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($compra) {
                $compra->producto = Producto::find($compra->producto_id);
                return $compra;
            });

        // Proveedores a los que más se les ha comprado
        $proveedoresMasComprados = Compra::select('proveedor_id', DB::raw('SUM(total) as total_comprado'))
            ->groupBy('proveedor_id')
            ->orderBy('total_comprado', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($compra) {
                $compra->proveedor = Proveedor::find($compra->proveedor_id);
                return $compra;
            });

        // Compra más grande
        $compraMasGrande = Compra::orderBy('total', 'desc')->first();

        // Compras más grandes del mes pasado
        $comprasMesPasado = Compra::whereBetween('fecha_compra', [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth()
            ])
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Compras más grandes del mes actual
        $comprasMesActual = Compra::whereBetween('fecha_compra', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return view('pages.reportes.compras', compact(
            'productosMasComprados',
            'proveedoresMasComprados',
            'compraMasGrande',
            'comprasMesPasado',
            'comprasMesActual'
        ));
    }
    
}