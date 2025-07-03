<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoFactory> */
    use HasFactory;

    protected $fillable = [
        'codigo',
        'total_a_pagar',
        'id_cliente',
        'nombres_cliente',
        'apellidos_cliente',
        'direccion_cliente',
        'nacionalidad_cliente',
        'cedula_cliente',
        'telefono_cliente',
        'email_cliente',
        'fecha_inicio',
        'fecha_entrega',
        'tasa',
        'estatus'
    ];
}
