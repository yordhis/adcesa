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
        $user->nombres = "ADMINISTRADOR";
        $user->rol = 1; 
        $user->email = "administrador@adcesa.com";
        $user->password = Hash::make(12345678);
        $user->save();
    }
}
