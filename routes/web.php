<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\FormaDePagoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum'])->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/test', function () {
       return view('pages/test/test');
    })->name('test');

    Route::get('/reportes/ventas', [ReporteController::class, 'reporteVentas'])->name('reportes.ventas');
    Route::get('/reportes/ventas-por-categoria', [ReporteController::class, 'reporteVentasPorCategoria'])->name('reportes.ventas-por-categoria');
    Route::get('/reportes/ventas-por-cliente', [ReporteController::class, 'reporteVentasPorCliente'])->name('reportes.ventas-por-cliente');
    Route::get('/reportes/clientes', [ReporteController::class, 'reporteClientes'])->name('reportes.clientes');
    Route::get('/reportes/proovedores', [ReporteController::class, 'reporteProveedores'])->name('reportes.proveedores');
    Route::get('/reportes/productos', [ReporteController::class, 'reporteProductos'])->name('reportes.productos');
    Route::get('/reportes/stock', [ReporteController::class, 'reporteStock'])->name('reportes.stock');
    Route::get('/reportes/compras', [ReporteController::class, 'reporteCompras'])->name('reportes.compras');

    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
    Route::get('/ventas/detail/{venta}', [VentaController::class, 'detail'])->name('ventas.detail');
    Route::get('/ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show');
    Route::get('/ventas/{venta}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
    Route::put('/ventas/{venta}', [VentaController::class, 'update'])->name('ventas.update');
    Route::delete('/ventas/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');

    Route::get('/inventarios', [InventarioController::class, 'index'])->name('inventarios.index');
    Route::get('/inventarios/create', [InventarioController::class, 'create'])->name('inventarios.create');
    Route::post('/inventarios', [InventarioController::class, 'store'])->name('inventarios.store');
    Route::get('/inventarios/{inventario}', [InventarioController::class, 'show'])->name('inventarios.show');
    Route::get('/inventarios/{inventario}/edit', [InventarioController::class, 'edit'])->name('inventarios.edit');
    Route::put('/inventarios/{inventario}', [InventarioController::class, 'update'])->name('inventarios.update');
    Route::delete('/inventarios/{inventario}', [InventarioController::class, 'destroy'])->name('inventarios.destroy');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');
    Route::get('/compras/create', [CompraController::class, 'create'])->name('compras.create');
    Route::post('/compras', [CompraController::class, 'store'])->name('compras.store');
    Route::get('/compras/{compra}', [CompraController::class, 'show'])->name('compras.show');
    Route::get('/compras/{compra}/edit', [CompraController::class, 'edit'])->name('compras.edit');
    Route::put('/compras/{compra}', [CompraController::class, 'update'])->name('compras.update');
    Route::delete('/compras/{compra}', [CompraController::class, 'destroy'])->name('compras.destroy');

    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
    Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('/proveedores/{proveedor}', [ProveedorController::class, 'show'])->name('proveedores.show');
    Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
    Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
    Route::delete('/proveedores/{proveedor}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');

    Route::get('/forma-pago', [FormaDePagoController::class, 'index'])->name('forma-pago.index');
    Route::get('/forma-pago/create', [FormaDePagoController::class, 'create'])->name('forma-pago.create');
    Route::post('/forma-pago', [FormaDePagoController::class, 'store'])->name('forma-pago.store');
    Route::get('/forma-pago/{formaPago}', [FormaDePagoController::class, 'show'])->name('forma-pago.show');
    Route::get('/forma-pago/{formaPago}/edit', [FormaDePagoController::class, 'edit'])->name('forma-pago.edit');
    Route::put('/forma-pago/{formaPago}', [FormaDePagoController::class, 'update'])->name('forma-pago.update');
    Route::delete('/forma-pago/{formaPago}', [FormaDePagoController::class, 'destroy'])->name('forma-pago.destroy');

    Route::get('/vendedores', [VendedorController::class, 'index'])->name('vendedores.index');
    Route::get('/vendedores/create', [VendedorController::class, 'create'])->name('vendedores.create');
    Route::post('/vendedores', [VendedorController::class, 'store'])->name('vendedores.store');
    Route::get('/vendedores/{vendedor}', [VendedorController::class, 'show'])->name('vendedores.show');
    Route::get('/vendedores/{vendedor}/edit', [VendedorController::class, 'edit'])->name('vendedores.edit');
    Route::put('/vendedores/{vendedor}', [VendedorController::class, 'update'])->name('vendedores.update');
    Route::delete('/vendedores/{vendedor}', [VendedorController::class, 'destroy'])->name('vendedores.destroy');

    Route::get('/cotizaciones', [CotizacionController::class, 'index'])->name('cotizaciones.index');
    Route::get('/cotizaciones/create', [CotizacionController::class, 'create'])->name('cotizaciones.create');
    Route::post('/cotizaciones', [CotizacionController::class, 'store'])->name('cotizaciones.store');
    Route::get('/cotizaciones/detail/{cotizacion}', [CotizacionController::class, 'detail'])->name('cotizaciones.detail');
    Route::get('/cotizaciones/{cotizacion}', [CotizacionController::class, 'show'])->name('cotizaciones.show');
    Route::get('/cotizaciones/{cotizacion}/edit', [CotizacionController::class, 'edit'])->name('cotizaciones.edit');
    Route::put('/cotizaciones/{cotizacion}', [CotizacionController::class, 'update'])->name('cotizaciones.update');
    Route::delete('/cotizaciones/{cotizacion}', [CotizacionController::class, 'destroy'])->name('cotizaciones.destroy');


    Route::fallback(function() {
        return view('pages/utility/404');
    });    
});
