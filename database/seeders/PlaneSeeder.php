<?php

namespace Database\Seeders;

use App\Models\Plane;
use Illuminate\Database\Seeder;

class PlaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planes = [
            [
                "codigo" => "0001",
                "nombre" => "DUO CREDITO",
                "cantidad_cuotas" => 3,
                "plazo" => 30,
                "descripcion" => "OBTEN UN DESCUENTO DE 10% SI TE INSCRIBES CON UN AMIGO",
                "porcentaje_descuento" => 10,
            ],
            [
                "codigo" => "0002",
                "nombre" => "DUO CONTADO",
                "cantidad_cuotas" => 1,
                "plazo" => 1,
                "descripcion" => "OBTEN UN DESCUENTO DE 30% SI TE INSCRIBES CON UN AMIGO",
                "porcentaje_descuento" => 30,
            ],
            [
                "codigo" => "0003",
                "nombre" => "INDIVIDUAL CONTADO",
                "cantidad_cuotas" => 1,
                "plazo" => 1,
                "descripcion" => "OBTEN UN DESCUENTO DE 10% SI TE INSCRIBES CON UN SOLO PAGO",
                "porcentaje_descuento" => 10,
            ],
            [
                "codigo" => "0004",
                "nombre" => "INDIVIDUAL CREDITO",
                "cantidad_cuotas" => 3,
                "plazo" => 30,
                "descripcion" => "¡TE DAMOS LA FACILIDAD DE PAGAR TU CURSO EN 3 CUOTAS MENSAUALES!",
                "porcentaje_descuento" => 0,
            ]
        ];

        foreach ($planes as $key => $plan) {
            Plane::create($plan);
        }
    }
}
