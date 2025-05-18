<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $rolUno = new Role();
       $rolUno->nombre = "ADMINISTRADOR";
       $rolUno->save();
       
       $rolDos = new Role();
       $rolDos->nombre = "ASISTENTE";
       $rolDos->save();
    }
}
