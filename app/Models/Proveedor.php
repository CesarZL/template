<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = ['nombre', 'nombre_contacto', 'correo', 'telefono'];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    
}


