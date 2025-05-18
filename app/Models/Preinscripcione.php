<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preinscripcione extends Model
{
    use HasFactory;

    protected $fillable = [
        "codigo",
        "cedula_estudiante",
        "codigo_plan",
        "codigo_nivel",
        "total",
        "abono",
        "comprobante",
        /** aqui puede ingresar el numero de referencia o el texto de deseo paagar en la academia */
        "referencia", 
        /** 0 pendiente - 1 completado */
        "estatus"
    ];
}
