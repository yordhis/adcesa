<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    /** @use HasFactory<\Database\Factories\CarritoFactory> */
    use HasFactory;

    protected $fillable = [
        'codigo_pedido',
        'id_producto',
        'id_variante',
        'nombre_producto',
        'tipo_producto',
        'alto_variante',
        'ancho_variante',
        'mas_detalles',
        'imagenes_adicionales',
        'medida_variante', // m, cm, u, etc.
        'cantidad',
        'precio',
        'sub_total',
    ];
}
