<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DataFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $clientesTop = Cliente::select('clientes.id', 'clientes.nombre', 'clientes.correo', DB::raw('SUM(ventas.total) as total_gastado'), DB::raw('MAX(ventas.fecha_de_venta) as ultima_compra'))
            ->join('ventas', 'clientes.id', '=', 'ventas.cliente_id')
            ->groupBy('clientes.id', 'clientes.nombre', 'clientes.correo')
            ->orderByDesc('total_gastado')
            ->take(5)
            ->get();
    
        return view('pages/dashboard/dashboard', compact('clientesTop'));
    }

    /**
     * Displays the analytics screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function analytics()
    {
        return view('pages/dashboard/analytics');
    }

    /**
     * Displays the fintech screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fintech()
    {
        return view('pages/dashboard/fintech');
    }
}
