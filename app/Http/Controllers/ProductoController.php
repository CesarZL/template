<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // buscar en la base de datos todos los productos
        $productos = Producto::all();

        // buscar la ultima compra del producto en el modelo compras
        $compras = Compra::all();
        foreach ($productos as $producto) {
            $compra = $compras->where('producto_id', $producto->id)->last();
            if ($compra) {
                $producto->ultima_compra = $compra->fecha_compra;
            } else {
                $producto->ultima_compra = 'No hay compras';
            }
        }   
        
        $title = 'Borrar producto';
        $text = "¿Estás seguro de que quieres borrar este producto?";
        confirmDelete($title, $text);

        return view('pages/productos.index', [
            'productos' => $productos
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('pages/productos.create',
            [
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
            'nombre' => 'required',
            'categoria_id' => 'required',
            'precio_venta' => 'required',
            'precio_compra' => 'required',
            'color' => 'required',
            'descripcion_corta' => 'required',
            'descripcion_larga' => 'required',
        ]);

        // guardar en la base de datos
        Producto::create($request->all());

        // redireccionar
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('pages/productos.show', 
            [
                'producto' => $producto,
                'categorias' => $categorias
            ]
        );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('pages/productos.edit', 
            [
                'producto' => $producto,
                'categorias' => $categorias
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        // validar los datos
        $request->validate([
            'nombre' => 'required',
            'categoria_id' => 'required',
            'precio_venta' => 'required',
            'precio_compra' => 'required',
            'color' => 'required',
            'descripcion_corta' => 'required',
            'descripcion_larga' => 'required',
        ]);

        // actualizar en la base de datos
        $producto->update($request->all());

        // redireccionar
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
         // eliminar de la base de datos
         $producto->delete();

         alert()->success('Producto eliminado con éxito');
         
         // redireccionar
         return redirect()->route('productos.index');
    }
}
