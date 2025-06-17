<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    /** @use HasFactory<\Database\Factories\InsumoFactory> */
    use HasFactory;

    protected $fillable = [
        'codigo_barra',
        'nombre',
        'precio',
        'costo',
        'cantidad', // cantidad del lote
        'unidad', // medidad de cada uno
        'stock', // existencia real
        'marca',
        'categoria',
        'almacen',
        'imagen',
        'estatus',
        'id_medida', 
        'id_almacen',
        'id_marca',
        'id_categoria',
    ];
}
