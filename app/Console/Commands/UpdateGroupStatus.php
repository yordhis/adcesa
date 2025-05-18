<?php
namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Grupo;
use App\Models\Inscripcione;
use Illuminate\Support\Facades\Process;

class UpdateGroupStatus 
{
    public function __invoke()
    {
        $grupos = Grupo::all();
        $now = Carbon::now();
        foreach ($grupos as $grupo) {
            if ($grupo->fecha_fin < $now) {
                $grupo->estatus = 2; // Periodo del curso terminado (inactivo o vencido)
                $grupo->save();

                Inscripcione::where('codigo_grupo', $grupo->codigo)
                ->update(['estatus' => 2]);
            }
        }
    }
}
