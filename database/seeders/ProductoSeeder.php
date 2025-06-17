<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productosCompuestos = [
            [
                "nombre" => "Aviso Publicitario",
                "descripcion" => "Aviso Publicitario",
                "id_categoria" => 1,
                "tipo_producto" => 1,
                "estatus" => 'INACTIVO',
            ],
            [
                "nombre" => "BANDERINES",
                "descripcion" => "BANDERINES",
                "id_categoria" => 1,
                "tipo_producto" => 1,
                "estatus" => 'INACTIVO',
            ],
            [
                "nombre" => "CARTELERAS ACRÍLICAS",
                "descripcion" => "CARTELERAS ACRÍLICAS",
                "id_categoria" => 1,
                "tipo_producto" => 1,
                "estatus" => 'INACTIVO',
            ],
            [
                "nombre" => "DISPLAY",
                "descripcion" => "DISPLAY",
                "id_categoria" => 1,
                "tipo_producto" => 1,
                "estatus" => 'INACTIVO',
            ],
            [
                "nombre" => "LETRAS CORPÓREAS",
                "descripcion" => "LETRAS CORPÓREAS",
                "id_categoria" => 1,
                "tipo_producto" => 1,
                "estatus" => 'INACTIVO',
            ],
            [
                "nombre" => "LETRAS NEÓN FLEX",
                "descripcion" => "LETRAS NEÓN FLEX",
                "id_categoria" => 1,
                "tipo_producto" => 1,
                "estatus" => 'INACTIVO',
            ],
            [
                "nombre" => "LOGO EN ACRÍLICO",
                "descripcion" => "LOGO EN ACRÍLICO",
                "id_categoria" => 1,
                "tipo_producto" => 1,
                "estatus" => 'INACTIVO',
            ],
            [
                "nombre" => "PENDÓN",
                "descripcion" => "PENDÓN",
                "id_categoria" => 1,
                "tipo_producto" => 1,
                "estatus" => 'INACTIVO',
            ],
            [
                "nombre" => "STICKERS",
                "descripcion" => "STICKERS",
                "id_categoria" => 1,
                "tipo_producto" => 1,
                "estatus" => 'INACTIVO',
            ],
            [
                "nombre" => "VALLAS",
                "descripcion" => "VALLAS",
                "id_categoria" => 1,
                "tipo_producto" => 1,
                "estatus" => 'INACTIVO',
            ],
        ];

        foreach ($productosCompuestos as $producto) {
            Producto::create($producto);
        }
    }
}
