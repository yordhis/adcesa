<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profesore;
class ProfesoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // profesor 1
        $profesor = new Profesore();
        $profesor->nombre = "Mario Perdomo";
        $profesor->nacionalidad = "V";
        $profesor->cedula = "24753789";
        $profesor->telefono = "0414-4857986";
        $profesor->correo = "enrriqueperdomo@gmail.com";
        $profesor->nacimiento = "1955-11-02";
        $profesor->edad = 75;
        $profesor->direccion = "Urb. Testing AC";
        $profesor->save();
        
        // profesor 2
        $profesorDos = new Profesore();
        $profesorDos->nombre = "Luis José Fandiño";
        $profesorDos->nacionalidad = "V";
        $profesorDos->cedula = "24753763";
        $profesorDos->telefono = "0414-4857986";
        $profesorDos->correo = "luis2025@gmail.com";
        $profesorDos->nacimiento = "1995-11-02";
        $profesorDos->edad = 28;
        $profesorDos->direccion = "Urb. Testing AC";
        $profesorDos->save();
        
        // profesor 3
        $profesorTres = new Profesore();
        $profesorTres->nombre = "Mike Garcia";
        $profesorTres->nacionalidad = "V";
        $profesorTres->cedula = "24753745";
        $profesorTres->telefono = "0414-4857986";
        $profesorTres->correo = "carlos5689@gmail.com";
        $profesorTres->nacimiento = "2000-11-02";
        $profesorTres->edad = 23;
        $profesorTres->direccion = "Urb. Testing AC";
        $profesorTres->save();
    }
}
