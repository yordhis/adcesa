<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;
use App\Models\{
    Cuota,
    Dashboard,
    DataDev,
    Estudiante,
    Grupo,
    GrupoEstudiante,
    Pago,
    Profesore
};
use Illuminate\Container\Attributes\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        // return session('permisos');
        // return $user = auth()->user();
        $respuesta = DataDev::$respuesta;
        $dataTarjetas = [
            "grupos" => 125,
            "estudiantes" => 300,
            "profesores" => 555,
            "cuotas" => 10,
            "pagos" => 100
        ];

        return view('admin.dashboard', compact('dataTarjetas', 'respuesta'));
    }
}
