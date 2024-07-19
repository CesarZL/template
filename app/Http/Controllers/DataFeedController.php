<?php

namespace App\Http\Controllers;

use App\Models\DataFeed;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataFeedController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getDataFeed(Request $request)
    {
        $datatype = $request->query('datatype');
        $limit = $request->query('limit', 10); // Puedes establecer un límite predeterminado

        if ($datatype === 'top_productos') {
            // Obtener los 3 productos más vendidos
            $topProductos = DB::table('venta_producto')
                ->select('producto_id', DB::raw('SUM(cantidad) as total_vendido'))
                ->groupBy('producto_id')
                ->orderBy('total_vendido', 'desc')
                ->limit(3)
                ->get();
            
            $labels = [];
            $data = [];
            
            foreach ($topProductos as $producto) {
                $productoInfo = Producto::find($producto->producto_id);
                $labels[] = $productoInfo->nombre;
                $data[] = $producto->total_vendido;
            }
            
            return response()->json([
                'labels' => $labels,
                'data' => $data,
            ]);
        }
         

        // Manejo para otros tipos de datos
        $df = new DataFeed();
        
        return response()->json([
            'labels' => $df->getDataFeed(
                $datatype,
                'label',
                $limit
            ),
            'data' => $df->getDataFeed(
                $datatype,
                'data',
                $limit
            ),
        ]);
    }
}
