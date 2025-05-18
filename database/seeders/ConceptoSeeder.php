<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{
    Concepto
};

class ConceptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conceptoUno = new Concepto;
        $conceptoUno->codigo = "HF-1";
        $conceptoUno->descripcion = "TRIMESTRE COMPLETO CURSO INGLES";
        $conceptoUno->save();

        $conceptoDos = new Concepto;
        $conceptoDos->codigo = "HF-2";
        $conceptoDos->descripcion = "ABONO A TRIMESTRE CURSO INGLES";
        $conceptoDos->save();

        $conceptoTres = new Concepto;
        $conceptoTres->codigo = "HF-3";
        $conceptoTres->descripcion = "ULTIMO ABONO A TRIMESTRE CURSO INGLES";
        $conceptoTres->save();

        $conceptoSei = new Concepto;
        $conceptoSei->codigo = "HF-4";
        $conceptoSei->descripcion = "MENSUALIDAD CURSO DE INGLES";
        $conceptoSei->save();
       
        $conceptoCua = new Concepto;
        $conceptoCua->codigo = "S-1";
        $conceptoCua->descripcion = "ASESORIA DE INGLES";
        $conceptoCua->save();

        $conceptoSin = new Concepto;
        $conceptoSin->codigo = "S-2";
        $conceptoSin->descripcion = "ABONO ASESORIA DE INGLES";
        $conceptoSin->save();
       
    }
}
