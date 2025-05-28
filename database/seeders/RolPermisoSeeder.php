<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Role;
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

        $permisosDeAdminitrador = [
            "panel",
            "clientes",
            "proveedores",
            "productos",
            "categorias",
            "marcas",
            "materia prima",
            "pagos",
            "pedidos",
            "configuraciones",
            "cuentas bancarias",
            "usuarios",
            "permisos",
            "roles",
            "reportes",
        ];

        $permisosDeGerente = [
            "panel",
            "clientes",
            "proveedores",
            "productos",
            "categorias",
            "marcas",
            "materia prima",
            "pagos",
            "pedidos",
            "configuraciones",
            "cuentas bancarias",
            "reportes",
        ];

        $permisosDeCliente = [
            "tienda",
        ];

        foreach ($permisosDeAdminitrador as $key => $value) {
            $permiso = new RolPermiso();
            $permiso->id_rol = Role::where('nombre', 'ADMINISTRADOR')->first()->id;
            $permiso->id_permiso = Permiso::where('nombre', $value)->first()->id;
            $permiso->save();
        }

        foreach ($permisosDeGerente as $key => $value) {
            $permiso = new RolPermiso();
            $permiso->id_rol = Role::where('nombre', 'GERENTE')->first()->id;
            $permiso->id_permiso = Permiso::where('nombre', $value)->first()->id;
            $permiso->save();
        }
        
        foreach ($permisosDeCliente as $key => $value) {
            $permiso = new RolPermiso();
            $permiso->id_rol = Role::where('nombre', 'CLIENTE')->first()->id;
            $permiso->id_permiso = Permiso::where('nombre', $value)->first()->id;
            $permiso->save();
        }

        
    }
}
