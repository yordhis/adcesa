<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variante extends Model
{
    /** @use HasFactory<\Database\Factories\VarianteFactory> */
    use HasFactory;

    protected $fillable = [
        "id_producto",
        "id_medida",
        "ancho",
        "alto",
        "precio"
    ];
}
