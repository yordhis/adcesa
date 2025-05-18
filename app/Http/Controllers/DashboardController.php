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

class DashboardController extends Controller
{

    public function index()
    {
        $dataTarjetas = [
            "grupos" => Grupo::where('estatus', 1)->count(),
            "estudiantes" => GrupoEstudiante::where('estatus', 1)->count(),
            "profesores" => Profesore::where('estatus', 1)->count(),
            "cuotas" => Cuota::where('estatus', 0)
            ->whereYear('fecha', date('Y'))
            ->whereMonth('fecha','=' , date('m'))
            ->whereDay('fecha','<', date('d'))
            ->count(),
            "pagos" => Pago::whereYear('fecha', date('Y'))
            ->whereMonth('fecha', date('m'))
            ->count()
        ];

        return view('admin.dashboard', compact('dataTarjetas'));
    }
}
