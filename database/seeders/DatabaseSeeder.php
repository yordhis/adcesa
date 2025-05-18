<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\{
    // UsuarioSeeder,
    UserSeeder,
    ProfesoreSeeder,
    EstudianteSeeder,
    DificultadeSeeder,
    NiveleSeeder,
    ConceptoSeeder
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(ProfesoreSeeder::class);
        $this->call(EstudianteSeeder::class);
        $this->call(DificultadeSeeder::class);
        $this->call(NiveleSeeder::class);
        $this->call(PlaneSeeder::class);
        $this->call(ConceptoSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermisoSeeder::class);
        $this->call(RolPermisoSeeder::class);
    }
}
