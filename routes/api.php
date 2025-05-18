<?php

use App\Http\Controllers\ApiController;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/getCodigoInscripcion/{incrementar}', [ApiController::class, 'getCodigoInscripcion'])->name('api.getCodigoInscripcion');
    Route::get('/getEstudiante/{cedula}', [ApiController::class, 'getEstudiante'])->name('api.getEstudiante');
    Route::get('/getRepresentante/{cedula}', [ApiController::class, 'getRepresentante'])->name('api.getRepresentante');
    Route::get('/grupo/{codigo}', [ApiController::class, 'getGrupo'])->name('api.getGrupo');
    Route::get('/plan/{codigo}', [ApiController::class, 'getPlan'])->name('api.getPlan');
    Route::post('/createCuotas', [ApiController::class, 'createCuotas'])->name('api.createCuotas');
// });
