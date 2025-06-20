<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    /** @use HasFactory<\Database\Factories\CuentaFactory> */
    use HasFactory;

    protected $fillable = [
        'codigo_banco',
        'nombre_banco',
        'numero_cuenta',
        'telefono',
        'titular',
        'tipo_cuenta', // Ahorros, Corriente, etc.
        'metodo', // Transferencia, Deposito, etc.
        'estatus', // 1: Activo, 0: Inactivo
    ];
}
