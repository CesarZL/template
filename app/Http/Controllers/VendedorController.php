<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendedores = Vendedor::all();

        $title = 'Borrar vendedor';
        $text = "¿Estás seguro de que quieres borrar a este vendedor?";
        confirmDelete($title, $text);


        return view('pages/vendedores.index',
            ['vendedores' => $vendedores]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages/vendedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'correo' => 'required|email|unique:users,email',
            'telefono' => 'required|string',
            'password' => 'required|string',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['nombre'],
            'email' => $validatedData['correo'],
            'created_by' => auth()->user()->id,
            'rol' => '0', // 1 is admin, 0 is user
            'password' => Hash::make($validatedData['password']),
        ]);

        // Create the vendedor associated with the user
        $vendedor = Vendedor::create([
            'telefono' => $validatedData['telefono'],
            'user_id' => $user->id,
        ]);
        
        // Optionally, redirect somewhere after creation
        return redirect()->route('vendedores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendedor $vendedor)
    {
        return view('pages/vendedores.show',
            ['vendedor' => $vendedor]
        );    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendedor $vendedor)
    {
        return view('pages/vendedores.edit',
            ['vendedor' => $vendedor]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendedor $vendedor)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'correo' => 'required|email|unique:users,email,' . $vendedor->user->id,
            'telefono' => 'required|string',
            'password' => 'required|string',
        ]);

        // Update the user
        $vendedor->user->update([
            'name' => $validatedData['nombre'],
            'email' => $validatedData['correo'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Update the vendedor associated with the user
        $vendedor->update([
            'telefono' => $validatedData['telefono'],
        ]);

        // Optionally, redirect somewhere after update
        return redirect()->route('vendedores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendedor $vendedor)
    {
        $vendedor->user->delete();
        $vendedor->delete();

        alert()->success('Vendedor eliminado con éxito');
        
        return redirect()->route('vendedores.index');
    }
}
