<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\StorePageRepresentanteRequest;
use App\Http\Requests\StorePageRequest;
use App\Models\DataDev;
use App\Models\Dificultade;
use App\Models\DificultadEstudiante;
use App\Models\Estudiante;
use App\Models\Helpers;
use App\Models\Nivele;
use App\Models\Plane;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{
    // Landinpage
    public function index()
    {
        $respuesta = DataDev::$respuesta;
        return view('page.home.index', compact('respuesta'));
    }
}
