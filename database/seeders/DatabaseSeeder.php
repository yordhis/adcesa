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
        $this->call(RoleSeeder::class);
        $this->call(PermisoSeeder::class);
        $this->call(RolPermisoSeeder::class);
        $this->call(UserSeeder::class);
        \App\Models\User::factory(30)->create();
    }
}
