<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['vendedor_id', 'producto_id', 'categoria_id', 'cliente_id', 'Fecha de venta', 'pago_id', 'Cambio', 'Subtotal', 'IVA', 'Total'];
}
