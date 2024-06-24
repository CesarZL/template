<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'categoria_id', 'precio_venta', 'precio_compra', 'color', 'descripcion_corta', 'descripcion_larga'];

    //relacion uno a muchos
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    //relacion uno a muchos
    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    //relacion uno a muchos
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}

