<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1: Admin, 2: Asistente, 3: Usuario cliente
        $user = new User();
        $user->nombres = "adcesa";
        $user->rol = 1; 
        $user->email = "admin@adcesa.com";
        $user->password = Hash::make(12345678);
        $user->save();
        
        $userDos = new User();
        $userDos->rol = 2;
        $userDos->nombres = "Asistente";
        $userDos->email = "assistant@adcesa.com";
        $userDos->password = Hash::make(12345678);
        $userDos->save();
    }
}
