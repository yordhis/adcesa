<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $fillable = [
        "codigo",
        "nombre",
        "cantidad_cuotas",
        "cantidad_estudiantes",
        "plazo",
        "descripcion",
        "porcentaje_descuento",
        "estatus", /** 0 = eliminado; 1 = Activo para el sistema; 2 = Activo para elsistema y la WEB */
    ];
}
