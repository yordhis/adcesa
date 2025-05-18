<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoEstudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_grupo',
        'cedula_estudiante',
        'estatus'
    ];
}
