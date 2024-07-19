<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // buscar en la base de datos todos los productos
        $proveedores = Proveedor::all();

        $title = 'Borrar proveedor';
        $text = "¿Estás seguro de que quieres borrar este proveedor?";
        confirmDelete($title, $text);


        return view('pages/proveedores.index', [
            'proveedores' => $proveedores
        ]);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages/proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // validar los datos
         $request->validate([
            'nombre' => 'required',
            'nombre_contacto' => 'required',
            'correo' => 'required',
            'telefono' => 'required',
        ]);

        // guardar en la base de datos
        Proveedor::create($request->all());

        // redireccionar
        return redirect()->route('proveedores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        return view('pages/proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        return view('pages/proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        // validar los datos
        $request->validate([
            'nombre' => 'required',
            'nombre_contacto' => 'required',
            'correo' => 'required',
            'telefono' => 'required',
        ]);

        // actualizar en la base de datos
        $proveedor->update($request->all());

        // redireccionar
        return redirect()->route('proveedores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        // eliminar de la base de datos
        $proveedor->delete();

        alert()->success('Proveedor eliminado con éxito');
        
        // redireccionar
        return redirect()->route('proveedores.index');
    }
}
