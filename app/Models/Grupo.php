<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'codigo_nivel',
        'cedula_profesor',
        'dias', 
        'hora_inicio',
        'hora_fin',
        'fecha_inicio',
        'fecha_fin',
        'estatus' /** 0 = borrado suave |  1 = activo | 2 = Periodo del curso terminado (inactivo o vencido) */
    ];
  
}
