<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventarios = Inventario::all();
        return view('pages/inventarios.index', [
            'inventarios' => $inventarios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        return view('pages/inventarios.create',
            [
                'productos' => $productos,
                'categorias' => $categorias
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
            'producto_id' => 'required',
            'motivo' => 'required',
            'cantidad' => 'required',
        ]);

        $inventario = new Inventario();
        $inventario->producto_id = $request->input('producto_id');
        $inventario->fecha_entrada = now();
        $inventario->movimiento = 'Entrada'; // 'Entrada' o 'Salida
        $inventario->motivo = $request->input('motivo');
        $inventario->cantidad = $request->input('cantidad');
        $inventario->save();

        return redirect()->route('inventarios.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        // dd($inventario);
        return view('pages/inventarios.show', [
            'inventario' => $inventario,
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        // dd($inventario);
        return view('pages/inventarios.edit', [
            'inventario' => $inventario,
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventario $inventario)
    {
        // validar los datos
        $request->validate([
            'producto_id' => 'required',
            'movimiento' => 'required',
            'motivo' => 'required',
            'cantidad' => 'required',
        ]);

        $cantidad = Inventario::where('id', $inventario->id)->first()->cantidad;
        // revisa que el producto tenga suficiente cantidad en inventario para quitarse, sino retorna un error
        if ($request->input('movimiento') == 'Salida' && $cantidad < $request->input('cantidad')) {
            return back()->withErrors(['cantidad' => 'No hay suficiente cantidad en inventario para realizar la salida'])->withInput();
        }

        if ($request->input('movimiento') == 'Salida') {
            $inventario->fecha_salida = now();
            $inventario->cantidad = $cantidad - $request->input('cantidad');
        }else{
            $inventario->fecha_entrada = now();
            $inventario->cantidad = $cantidad + $request->input('cantidad');
        }

        $inventario->producto_id = $request->input('producto_id');
        $inventario->movimiento = $request->input('movimiento');
        $inventario->motivo = $request->input('motivo');
        $inventario->save();
        return redirect()->route('inventarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->delete();
        return redirect()->route('inventarios.index');
    }
}
