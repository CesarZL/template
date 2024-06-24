<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'cliente_id', 'fecha_cot', 'Vigencia', 'comentarios'];
}
