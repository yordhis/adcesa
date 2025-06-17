<?php

namespace Database\Seeders;

use App\Models\Almacen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           $almacenes = [
                [ 'nombre' => 'Almacen A'],
                [ 'nombre' => 'Almacen B'],
            ];

           foreach ($almacenes as $key => $value) {
               $almacen = new Almacen();
               $almacen->nombre = $value['nombre'];
               $almacen->save();
           }
    }
}
