<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "nombre", 
        "cedula",
        "telefono",
        "correo",
        "nacimiento",
        "edad",
        "direccion",
        "ocupacion",
        "estatus"
    ];
    
                    
                   
}
