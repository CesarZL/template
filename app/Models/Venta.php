<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cliente_id', 'fecha_de_venta', 'pago_id', 'Cambio', 'Subtotal', 'IVA', 'Total'];

    public function formaDePago()
    {
        return $this->belongsTo(FormaDePago::class, 'pago_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'venta_producto')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

}
