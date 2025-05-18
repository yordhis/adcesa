<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estudiante;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Estudiante 1
        $estudiante = new Estudiante();
        $estudiante->nombre = "Enrrique Perdomo";
        $estudiante->nacionalidad = "V";
        $estudiante->cedula = "24753789";
        $estudiante->telefono = "0414-4857986";
        $estudiante->correo = "enrriqueperdomo@gmail.com";
        $estudiante->nacimiento = "1955-11-02";
        $estudiante->edad = 75;
        $estudiante->direccion = "Urb. Testing AC";
        $estudiante->save();
        
        // Estudiante 2
        $estudianteDos = new Estudiante();
        $estudianteDos->nombre = "Luis Fandiño";
        $estudianteDos->nacionalidad = "V";
        $estudianteDos->cedula = "24753763";
        $estudianteDos->telefono = "0414-4857986";
        $estudianteDos->correo = "luis2025@gmail.com";
        $estudianteDos->nacimiento = "1995-11-02";
        $estudianteDos->edad = 28;
        $estudianteDos->direccion = "Urb. Testing AC";
        $estudianteDos->save();

        // Estudiante 3
        $estudianteTres = new Estudiante();
        $estudianteTres->nombre = "Carlos Garcia";
        $estudianteTres->nacionalidad = "V";
        $estudianteTres->cedula = "24753745";
        $estudianteTres->telefono = "0414-4857986";
        $estudianteTres->correo = "carlos5689@gmail.com";
        $estudianteTres->nacimiento = "2000-11-02";
        $estudianteTres->edad = 23;
        $estudianteTres->direccion = "Urb. Testing AC";
        $estudianteTres->save();
    
    }
}
