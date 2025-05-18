<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dificultade;
class DificultadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dificultadUno = new Dificultade();
        $dificultadUno->nombre = "TDH";
        $dificultadUno->save();

        $dificultadDos = new Dificultade();
        $dificultadDos->nombre = "ASPERGER";
        $dificultadDos->save();

        $dificultadTres = new Dificultade();
        $dificultadTres->nombre = "AUTISMO";
        $dificultadTres->save();
    }
}
