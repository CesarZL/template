<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Cotizacion;
use Illuminate\Http\Request;
use Carbon\Carbon;


class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cotizaciones = Cotizacion::all();

        $title = 'Borrar cotización';
        $text = "¿Estás seguro de que quieres borrar esta cotización?";
        confirmDelete($title, $text);

        return view('pages/cotizaciones.index', [
            'cotizaciones' => $cotizaciones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('pages/cotizaciones.create', [
            'clientes' => $clientes,
            'productos' => $productos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vigencia' => 'required|date',
            'comentarios' => 'nullable|string',
            'productos' => 'required|array|min:1', // Al menos un producto debe estar seleccionado
            'productos.*' => 'sometimes|exists:productos,id', // Permitir algunos productos no seleccionados
            'cantidades.*' => 'nullable|integer|min:0', // Permitir cantidades de 0
        ], [
            'productos.min' => 'Selecciona al menos un producto con cantidad mayor a 0.',
        ]);
    
        // Verificar que al menos un producto esté seleccionado con cantidad mayor a 0
        $valid = false;
        foreach ($request->productos as $key => $producto_id) {
            if (isset($request->cantidades[$producto_id]) && $request->cantidades[$producto_id] > 0) {
                $valid = true;
                break;
            }
        }
    
        if (!$valid) {
            return redirect()->back()->withErrors(['productos' => 'Selecciona al menos un producto con cantidad mayor a 0.'])->withInput();
        }
    
        // Lógica para crear la cotización
        $cotizacion = new Cotizacion();
        $cotizacion->cliente_id = $request->cliente_id;
        $cotizacion->fecha_cot = now(); // Puedes ajustar la fecha según tu lógica
        $cotizacion->vigencia = $request->vigencia;
        $cotizacion->comentarios = $request->comentarios;
        $cotizacion->save();
    
        // Guardar los productos seleccionados con cantidades
        foreach ($request->productos as $producto_id) {
            if (isset($request->cantidades[$producto_id]) && $request->cantidades[$producto_id] > 0) {
                $cotizacion->productos()->attach($producto_id, ['cantidad' => $request->cantidades[$producto_id]]);
            }
        }
    
        // Redirigir o hacer lo que necesites después de guardar
        return redirect()->route('cotizaciones.index');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Cotizacion $cotizacion)
    {

        // Calcular subtotal antes de IVA
        $subtotal = $cotizacion->productos->sum(function ($producto) {
            return $producto->pivot->cantidad * $producto->precio_venta;
        });

        $iva = $subtotal / 1.16;

        $subtotal = $subtotal - $iva;

        $total = $subtotal + $iva;

        $diasVigencia = Carbon::parse($cotizacion->vigencia)->diffInDays(now());
    
        return view('pages.cotizaciones.show', compact('cotizacion', 'subtotal', 'iva', 'total', 'diasVigencia'));
    }
    
    public function detail(Cotizacion $cotizacion)
    {
        // Cargar los productos relacionados con la cotización
        $cotizacion->load('productos');
    
        return view('pages.cotizaciones.detail', [
            'cotizacion' => $cotizacion,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cotizacion $cotizacion)
    {
        $clientes = Cliente::all(); // Asegúrate de tener el modelo y la relación correcta aquí
        $productos = Producto::all(); // Asegúrate de tener el modelo y la relación correcta aquí
    
        // Obtener productos asociados a la cotización
        $productos_cotizacion = $cotizacion->productos->pluck('id')->toArray();
        
        // Obtener cantidades de productos asociadas a la cotización
        $cantidades = [];
        foreach ($cotizacion->productos as $producto) {
            $cantidades[$producto->id] = $producto->pivot->cantidad;
        }
    
        return view('pages.cotizaciones.edit', [
            'cotizacion' => $cotizacion,
            'clientes' => $clientes,
            'productos' => $productos,
            'productos_cotizacion' => $productos_cotizacion,
            'cantidades' => $cantidades
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cotizacion $cotizacion)
    {
        // Validación personalizada para verificar al menos un producto seleccionado
        $request->validate([
            'cliente_id' => 'required',
            'fecha_cot' => 'required|date',
            'vigencia' => 'required|date',
            'comentarios' => 'nullable|string',
            'productos' => 'required|array|min:1', // Al menos un producto debe estar presente
        ]);

        // si algun producto fue seleccionado pero no se ingreso cantidad se debe mostrar un error
        foreach ($request->productos as $key => $producto_id) {
            if (isset($request->cantidades[$producto_id]) && $request->cantidades[$producto_id] == 0) {
                return redirect()->back()->withErrors(['productos' => 'Ingresa una cantidad mayor a 0 para el producto seleccionado.'])->withInput();
            }
        }


        // Actualizar los datos básicos de la cotización
        $cotizacion->update([
            'cliente_id' => $request->cliente_id,
            'fecha_cot' => $request->fecha_cot,
            'vigencia' => $request->vigencia,
            'comentarios' => $request->comentarios,
        ]);
    
        // Sincronizar los productos asociados con sus cantidades
        if ($request->productos && $request->cantidades) {
            $productos_sync = [];
            foreach ($request->productos as $key => $producto_id) {
                if (isset($request->cantidades[$producto_id]) && $request->cantidades[$producto_id] > 0) {
                    $productos_sync[$producto_id] = ['cantidad' => $request->cantidades[$producto_id]];
                }
            }
            $cotizacion->productos()->sync($productos_sync);
        } else {
            // Si no se seleccionan productos, eliminar todos los productos asociados
            $cotizacion->productos()->detach();
        }
    
        return redirect()->route('cotizaciones.show', $cotizacion->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cotizacion $cotizacion)
    {
        $cotizacion->delete();
        alert()->success('Cotización eliminada con éxito');
        return redirect()->route('cotizaciones.index');
    }
}
