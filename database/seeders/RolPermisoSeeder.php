<?php

namespace Database\Seeders;

use App\Models\RolPermiso;
use Illuminate\Database\Seeder;

class RolPermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            "administrador" => 1,
            "asistente" => 2
        ];

        $permososDeAdminitrador = [
            "panel" => 1,
            "profesores" => 2,
            "estudiantes" => 3,
            "niveles" => 4,
            "planes" => 5,
            "grupos" => 6,
            "pagos" => 7,
            "inscripciones" => 8,
            "configuraciones" => 9,
            "conceptos" => 10,
            "usaurios" => 11,
        ];

        $permososDeAsistente = [
            "panel" => 1,
            "profesores" => 2,
            "estudiantes" => 3,
            "niveles" => 4,
            "planes" => 5,
            "grupos" => 6,
            "pagos" => 7,
            "inscripciones" => 8
        ];

        foreach ($permososDeAdminitrador as $key => $value) {
            $permiso = new RolPermiso();
            $permiso->id_rol = $roles['administrador'];
            $permiso->id_permiso = $value;
            $permiso->save();
        }

        foreach ($permososDeAsistente as $key => $value) {
            $permiso = new RolPermiso();
            $permiso->id_rol = $roles['asistente'];
            $permiso->id_permiso = $value;
            $permiso->save();
        }
    }
}
