<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Inventario;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::all();

        $title = 'Borrar compra';
        $text = "¿Estás seguro de que quieres borrar esta compra?";
        confirmDelete($title, $text);


        return view('pages/compras.index', [
            'compras' => $compras
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        return view('pages/compras.create',
            [
                'productos' => $productos,
                'proveedores' => $proveedores
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar los datos
        $request->validate([
            'proveedor_id' => 'required',
            'producto_id' => 'required',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0.01',
            'fecha_compra' => 'required|date',
            'descuento' => 'nullable|numeric|min:0|max:100',
        ]);

        $compra = new Compra();
        $compra->proveedor_id = $request->input('proveedor_id');
        $compra->producto_id = $request->input('producto_id');
        $compra->cantidad = $request->input('cantidad');
        $compra->precio = $request->input('precio');
        $compra->fecha_compra = $request->input('fecha_compra');
        if ($request->input('descuento') == null) {
            $compra->descuento = 0;
        } else {
            $compra->descuento = $request->input('descuento');
        }
        $compra->total = ($request->input('cantidad') * $request->input('precio')) * ((100 - $request->input('descuento')) / 100);
        $compra->save();

        // aumentar la cantidad en el inventario
        $producto = Inventario::where('producto_id', $request->input('producto_id'))->first();
        if ($producto) {
            $producto->cantidad += $request->input('cantidad');
            $producto->fecha_entrada = now();
            $producto->movimiento = 'Entrada';
            $producto->motivo = 'Compra';
            $producto->save();
        } else {
            $producto = new Inventario();
            $producto->producto_id = $request->input('producto_id');
            $producto->fecha_entrada = now();
            $producto->movimiento = 'Entrada';
            $producto->motivo = 'Compra';
            $producto->cantidad = $request->input('cantidad');
            $producto->save();
        }

        //cambiar el precio de venta del producto
        $producto = Producto::find($request->input('producto_id'));
        $producto->precio_compra = $request->input('precio');
        $producto->save();

        return redirect()->route('compras.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        return view('pages/compras.show', [
            'compra' => $compra,
            'productos' => $productos,
            'proveedores' => $proveedores
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        // dd($compra);
        return view('pages/compras.edit', [
            'compra' => $compra,
            'proveedores' => $proveedores,
            'productos' => $productos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        // Validar los datos
        $request->validate([
            'proveedor_id' => 'required',
            'producto_id' => 'required',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0.01',
            'fecha_compra' => 'required|date',
            'descuento' => 'nullable|numeric|min:0|max:100',
        ]);
    
        // Obtener la cantidad original antes de la actualización
        $cantidadOriginal = $compra->cantidad;
    
        // Actualizar los datos de la compra
        $compra->proveedor_id = $request->input('proveedor_id');
        $compra->producto_id = $request->input('producto_id');
        $compra->cantidad = $request->input('cantidad');
        $compra->precio = $request->input('precio');
        $compra->fecha_compra = $request->input('fecha_compra');
        if ($request->input('descuento') == null) {
            $compra->descuento = 0;
        } else {
            $compra->descuento = $request->input('descuento');
        }
        $compra->total = ($request->input('cantidad') * $request->input('precio')) * ((100 - $request->input('descuento')) / 100);
        $compra->save();
    
        // Calcular la diferencia de cantidad
        $diferenciaCantidad = $request->input('cantidad') - $cantidadOriginal;
    
        // Actualizar la cantidad en el inventario
        $producto = Inventario::where('producto_id', $request->input('producto_id'))->first();
        if ($producto) {
            $producto->cantidad += $diferenciaCantidad;
            $producto->save();
        } else {
            $producto = new Inventario();
            $producto->producto_id = $request->input('producto_id');
            $producto->fecha_entrada = now();
            $producto->movimiento = 'Entrada';
            $producto->motivo = 'Compra';
            $producto->cantidad = $request->input('cantidad');
            $producto->save();
        }
    
        // Cambiar el precio de venta del producto
        $producto = Producto::find($request->input('producto_id'));
        $producto->precio_compra = $request->input('precio');
        $producto->save();
    
        return redirect()->route('compras.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        // Obtener el producto asociado a la compra
        $producto = Inventario::where('producto_id', $compra->producto_id)->first();
    
        // Verificar si el producto existe en el inventario
        if ($producto) {
            // Revertir la cantidad de la compra en el inventario
            $producto->cantidad -= $compra->cantidad;
    
            // Asegurarse de que la cantidad no sea negativa
            if ($producto->cantidad < 0) {
                $producto->cantidad = 0;
            }
    
            // Guardar los cambios en el inventario
            $producto->save();
        }
    
        // Eliminar la compra
        $compra->delete();
    
        alert()->success('Compra eliminada con éxito');
        // Redirigir a la lista de compras
        return redirect()->route('compras.index');
    }
    
}
