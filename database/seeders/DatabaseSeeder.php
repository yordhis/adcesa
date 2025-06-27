<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MedidaSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermisoSeeder::class);
        $this->call(RolPermisoSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TasaSeeder::class);
    }
}
