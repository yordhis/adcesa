<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            "panel",
            "clientes",
            "salidas",
            "productos",
            "categorias",
            "marcas",
            "insumos",
            "pagos",
            "pedidos",
            "configuraciones",
            "cuentas",
            "tasas",
            "users",
            "permisos",
            "roles",
            "reportes",
            "almacens",
            "variantes",
            "medidas",
            "insumotoproductos",
            "tienda",
        ];

        foreach ($permisos as $key => $value) {
            $permiso = new Permiso();
            $permiso->nombre = $value;
            $permiso->save();
        }

    }
}
