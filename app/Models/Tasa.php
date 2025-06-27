<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasa extends Model
{
    /** @use HasFactory<\Database\Factories\TasaFactory> */
    use HasFactory;

     protected $fillable = [
        "tasa",
    ];
}
