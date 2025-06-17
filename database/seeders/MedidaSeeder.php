<?php

namespace Database\Seeders;

use App\Models\Medida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medidas = [
            ['nombre' => 'METROS', 'simbolo' => 'M'],
            ['nombre' => 'CENTIMETROS',  'simbolo' => 'CM'],
            ['nombre' => 'UNIDAD', 'simbolo' => 'U'],
        ];

        foreach ($medidas as $key => $value) {
            $medida = new Medida();
            $medida->nombre = $value['nombre'];
            $medida->simbolo = $value['simbolo'];
            $medida->save();
        }
    }
}
