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
        'cantidad',
        'marca',
        'categoria',
        'imagen',
        'estatus',
        'id_marca',
        'id_categoria',
    ];
}
