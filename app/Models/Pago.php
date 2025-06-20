<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    // protected $table = 'pagos';

    protected $fillable = [
        'codigo_pedido',
        'id_cuenta',
        'monto',
        'fecha',
        'comprobante',
        'referencia',
        'metodo_pago',
        'codigo_cuenta',
        'titular_cuenta',
        'telefono_cuenta',
        'numero_cuenta',
        'nombre_cuenta',
        'estatus',
    ];
}
