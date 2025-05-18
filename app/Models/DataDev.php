<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class DataDev
{

    public static $respuesta = [
        "mensaje" => "No Funcionó",
        "activo" => null,
        "estatus" => 404,
        "clases" => [
            "200" => "bg-success",
            "201" => "bg-success",
            "301" => "bg-warning",
            "401" => "bg-warning",
            "400" => "bg-danger",
            "404" => "bg-danger",
            "500" => "bg-danger"
        ],
        "icono" => [
            "200" => "bi bi-check-circle me-1",
            "201" => "bi bi-check-circle me-1",
            "301" => "bi bi-exclamation-triangle me-1",
            "400" => "bi bi-exclamation-octagon me-1",
            "401" => "bi bi-exclamation-octagon me-1",
            "404" => "bi bi-exclamation-octagon me-1",
            "500" => "bi bi-exclamation-octagon me-1"
        ]
    ];

    public static $dias = [
        "Lunes",
        "Martes",
        "Miercoles",
        "Jueves",
        "Viernes",
        "Sabado",
        "Domingo"
    ];

    public static $metodosPagos = [ 
        "TD", 
        "TC", 
        "EFECTIVO", 
        "PAGO MOVIL", 
        "DIVISAS", 
        "TRANSFERENCIA", 
        "ZELLE", 
        "BIO PAGO", 
        "OTRO"
    ];
    
    public static $estatus = [
        "0" => "Eliminado",
        "1" => "Activo",
        "2" => "Inactivo",
        "3" => "Completado",
        "4" => "Pendiente"
    ];

    public static $respuestaTail = [
        "mensaje" => "No Funcionó",
        "activo" => null,
        "estatus" => 404,
        "clases" => [
            "200" => "bg-green-500",
            "201" => "bg-green-500",
            "301" => "bg-yellow-500",
            "401" => "bg-yellow-500",
            "404" => "bg-red-500",
            "500" => "bg-red-500"
        ],
        "icono" => [
            "200" => "bi bi-check-circle me-1",
            "201" => "bi bi-check-circle me-1",
            "301" => "bi bi-exclamation-triangle me-1",
            "401" => "bi bi-exclamation-octagon me-1",
            "404" => "bi bi-exclamation-octagon me-1",
            "500" => "bi bi-exclamation-octagon me-1"
        ]
    ];
}
