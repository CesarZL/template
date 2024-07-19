<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();

        $title = 'Borrar cliente';
        $text = "¿Estás seguro de que quieres borrar este cliente?";
        confirmDelete($title, $text);

        return view('pages/clientes.index', [
            'clientes' => $clientes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages/clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required | email',
            'telefono' => 'required | numeric | digits:10',
            'direccion' => 'required',
            'rfc' => 'required | max:13',
            'razon_social' => 'required',
            'cp' => 'required | numeric | digits:5',
            'regimen_fiscal' => 'required',
        ]);

        // guardar en la base de datos
        Cliente::create($request->all());

        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('pages/clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('pages/clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required | email',
            'telefono' => 'required | numeric | digits:10',
            'direccion' => 'required',
            'rfc' => 'required | max:13',
            'razon_social' => 'required',
            'cp' => 'required | numeric | digits:5',
            'regimen_fiscal' => 'required',
        ]);

        $cliente->nombre = $request->input('nombre');
        $cliente->correo = $request->input('correo');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->rfc = $request->input('rfc');
        $cliente->save();
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        alert()->success('Cliente eliminado con éxito');
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente');
    }
}
