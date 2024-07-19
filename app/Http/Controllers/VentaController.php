<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\FormaDePago;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::all();

        $title = 'Borrar venta';
        $text = "¿Estás seguro de que quieres borrar esta venta?";
        confirmDelete($title, $text);

        return view('pages/ventas.index', 
        [
            'ventas' => $ventas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $formasdepago = FormaDePago::all();
        $productos = Producto::all();
        $inventario = Inventario::all();

        // productos con cantidad en inventario en el objeto
        $productos_inventario = $productos->map(function ($producto) use ($inventario) {
            $producto->cantidad = $inventario->where('producto_id', $producto->id)->sum('cantidad');
            return $producto;
        });

        return view('pages/ventas.create', 
        [
            'clientes' => $clientes,
            'formasdepago' => $formasdepago,
            'productos_inventario' => $productos_inventario,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'pago_id' => 'required|exists:forma_de_pago,id',
            'monto' => 'nullable|numeric|min:0',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        // Validar el monto si el pago es en efectivo
        if ($validated['pago_id'] == 3) { // Efectivo
            $monto = $validated['monto'];
            if ($monto < $validated['total']) {
                return redirect()->back()->withErrors(['monto' => 'El monto recibido es menor que el total.']);
            }
        }
    
        // Crear la venta
        $venta = new Venta();
        $venta->user_id = auth()->id();
        $venta->fecha_de_venta = now();
        $venta->cliente_id = $validated['cliente_id'];
        $venta->pago_id = $validated['pago_id'];
        $venta->subtotal = $validated['subtotal'];
        $venta->IVA = $validated['iva'];
        $venta->total = $validated['total'];

        if ($validated['pago_id'] == 3) { // Efectivo
            $venta->cambio = $monto - $validated['total'];
        }

        $venta->save();
    
        // Procesar los productos
        foreach ($request->input('productos') as $producto) {
            $productoId = $producto['id'];
            $cantidad = $producto['cantidad'];
    
            // Validar que la cantidad solicitada no exceda el inventario
            $inventario = Inventario::where('producto_id', $productoId)->first();
            if ($inventario->cantidad < $cantidad) {
                return redirect()->back()->withErrors(['error' => "No hay suficiente stock para el producto ID $productoId"]);
            }
    
            // Reducir el inventario
            $inventario->cantidad -= $cantidad;
            $inventario->fecha_salida = now();
            $inventario->movimiento = 'Salida';
            $inventario->motivo = 'Venta';
            $inventario->save();
    
            // Agregar los detalles de la venta
            $venta->productos()->attach($productoId, ['cantidad' => $cantidad]);
        }

        if ($venta->pago_id == 3) { // Efectivo
            alert()->success('Venta realizada con éxito', 'el cambio es de: $' . $venta->cambio);
        } else {
            alert()->success('Venta realizada con éxito');
        }
    
        return redirect()->route('ventas.index')->with('success', 'Venta realizada con éxito');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function detail(Venta $venta)
    {
        // Cargar los productos relacionados con la cotización
        $venta->load('productos');    
        return view('pages.ventas.ticket', [
            'venta' => $venta,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        // Cargar los productos relacionados con la venta
        $venta->load('productos');
        
        // Revertir el inventario
        foreach ($venta->productos as $producto) {
            $inventario = Inventario::where('producto_id', $producto->id)->first();
            if ($inventario) {
                $inventario->cantidad += $producto->pivot->cantidad;
                $inventario->fecha_entrada = now();
                $inventario->movimiento = 'Entrada';
                $inventario->motivo = 'Venta revertida';
                $inventario->save();
            }
        }
        
        // Eliminar los registros en la tabla pivote
        $venta->productos()->detach();
        
        // Eliminar la venta
        $venta->delete();

        alert()->success('Venta eliminada con éxito');
    
        return redirect()->route('ventas.index');
    }
    
}
