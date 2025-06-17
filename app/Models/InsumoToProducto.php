<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsumoToProducto extends Model
{
    /** @use HasFactory<\Database\Factories\InsumoToProductoFactory> */
    use HasFactory;

     protected $fillable = [
        "id_producto",
        "id_insumo"
    ];
}
