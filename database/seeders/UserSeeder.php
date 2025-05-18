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
        $user = new User();
        $user->nombre = "adcesa";
        $user->rol = 1;
        $user->email = "admin@adcesa.com";
        $user->password = Hash::make(12345678);
        $user->save();

        $user = new User();
        $user->nombre = "Super usuario";
        $user->rol = 1;
        $user->email = "root@adcesa.com";
        $user->password = Hash::make("Cssi24823972/*/*");
        $user->save();

        $userDos = new User();
        $userDos->nombre = "Asistente";
        $userDos->email = "assistant@adcesa.com";
        $userDos->password = Hash::make(12345678);
        $userDos->save();
    }
}
