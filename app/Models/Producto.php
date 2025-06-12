<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $fillable = [
        'codigo_barra',
        'nombre',
        'descripcion',
        'tipo_producto',
        'precio',
        'imagen',
        'stock',
        'costo',
        'marca',
        'categoria',
        'almacen',
        'estatus',
        'id_almacen',
        'id_marca',
        'id_categoria',
    ];
}
