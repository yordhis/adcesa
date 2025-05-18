<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivele extends Model
{
    use HasFactory;

    protected $fillable = [
        "codigo",
        "nombre",
        "precio",
        "libro",
        "duracion",
        "tipo_duracion",
        "imagen",
        "tipo_nivel",
        "estatus"
    ];
}
