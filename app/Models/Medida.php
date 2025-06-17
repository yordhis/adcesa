<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    /** @use HasFactory<\Database\Factories\MedidaFactory> */
    use HasFactory;
    protected $fillable = [
        "nombre",
        "simbolo",
    ];
}
