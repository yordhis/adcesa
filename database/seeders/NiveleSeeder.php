<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Nivele, 
    Helpers
};

class NiveleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nivele = new Nivele();
        $nivele->codigo = Helpers::getCodigo("niveles");
        $nivele->nombre = 'Nivel 1';
        $nivele->precio = 270;
        $nivele->libro = "The Ingles - Volumen 1";
        $nivele->duracion = 3;
        $nivele->tipo_duracion = "Meses";
        $nivele->save();
       
        $niveleDos = new Nivele();
        $niveleDos->codigo = Helpers::getCodigo("niveles");
        $niveleDos->nombre = 'Nivel 2';
        $niveleDos->precio = 270;
        $niveleDos->libro = "The Ingles - Volumen 2";
        $niveleDos->duracion = 3;
        $niveleDos->tipo_duracion = "Meses";
        $niveleDos->save();
       
        $niveleTres = new Nivele();
        $niveleTres->codigo = Helpers::getCodigo("niveles");
        $niveleTres->nombre = 'Nivel 3';
        $niveleTres->precio = 270;
        $niveleTres->libro = "The Ingles - Volumen 3";
        $niveleTres->duracion = 3;
        $niveleTres->tipo_duracion = "Meses";
        $niveleTres->save();
    }
}
