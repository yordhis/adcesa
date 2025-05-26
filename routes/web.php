<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ClienteController,
    ConceptoController,
    CuotaController,
    UserController,
    DashboardController,
    ProfesoreController,
    EstudianteController,
    NiveleController,
    PlaneController,
    GrupoController,
    GrupoEstudianteController,
    PagoController,
    InscripcioneController,
    LoginController,
    NotaController,
    PageController,
    PreinscripcioneController,
    PreinscripcionePageController,
    RepresentanteController,
    RepresentanteEstudianteController
};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'index'])->name('page.index');

/** Rutas de usuario logeado */
Route::middleware('auth')->group(function () {
    Route::get('/home', [PageController::class, 'index'])->name('page.home');
});

Route::controller(PageController::class)->group( function () {
    Route::get('/preinscripcion/{codigo_nivel?}', 'create')->name('page.preinscripcion.index');
    Route::get('/preinscripcion/estudiante/{codigo_nivel?}/{codigo_plan?}', 'createEstudiante')->name('page.preinscripcion.estudiante');
    Route::post('/preinscripcion/registrar/estudiante', 'store')->name('page.preinscripcion.estudiante.store');
    Route::post('/preinscripcion/asignar/estudiante', 'asignarEstudianteExistente')->name('page.preinscripcion.asignar.estudiante');
    Route::post('/preinscripcion/registrar/representante', 'storeRepresentante')->name('page.registrar.representante');
    Route::get('/preinscripcion/asignar/representante', 'asignarRepresentante')->name('page.asignar.representante');
});

Route::controller(PreinscripcionePageController::class)->group(function () {
    Route::post('/preinscripcion', 'store')->name('page.preinscripcion.store');
});

/*
|--------------------------------------------------------------------------
| System Routes
|--------------------------------------------------------------------------
*/
Route::get('/entrar', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    /** Panel principal */
    Route::get('/panel', [DashboardController::class, 'index'])->name('admin.panel.index');

    /** Rutas de Profesor */
    Route::resource('/clientes', ClienteController::class)->names('admin.clientes');

    /** Cuotas */ 
    Route::get('/cuotas', [CuotaController::class, 'index'])->name('admin.coutas.index');
    
    /** Usuarios */
    Route::resource('/users', UserController::class)->names('admin.users');
    
    
    /** Rutas de Estudiante */
    Route::resource('/estudiantes', EstudianteController::class)->names('admin.estudiantes');
    
    /** Rutas de Representante */
    Route::resource('/representantes', RepresentanteController::class)->names('admin.representantes');
    
    /** Rutas de Representante ASIGNADOS AL ESTUDIANTE */
    Route::resource('/representanteEstudiates', RepresentanteEstudianteController::class)->names('admin.reprsentanteEstudiates');
    
    /** Rutas de Niveles de estudio */
    Route::resource('/niveles', NiveleController::class)->names('admin.niveles');
    
    /** Rutas de Planes de pago */
    Route::resource('/planes', PlaneController::class)->names('admin.planes');
    
    /** Rutas de Grupos de estudio */
    Route::get('/imprimirMatriculaDelGrupo/{codigoGrupo}', [GrupoController::class, 'imprimirMatriculaDelGrupo'])->name('admin.grupos.imprimir');
    Route::resource('/grupos', GrupoController::class)->names('admin.grupos');
    Route::resource('/grupoEstudiantes', GrupoEstudianteController::class)->names('admin.grupoEstudiantes');
    
    
    /** Rutas de Planes de pago */
    Route::get('/pagos/{cedula}/{codigo_inscripcion}', [PagoController::class, 'getPagoEstudiante'])->name('admin.pagos.process');
    Route::get('/generarReciboDePago/{cedula_estudiante}/{codigo_inscripcion}/', [PagoController::class, 'recibopdf'])->name('admin.pagos.recibopdf');
    Route::resource('/pagos', PagoController::class)->names('admin.pagos');
    
    /** Rutas de Inscripciones de estudiantes */
    Route::put('/inscripciones/reasignar', [InscripcioneController::class, 'reasignarGrupo'])->name('admin.inscripciones.reasignarGrupo');
    Route::get('/inscripciones/estudiante',[InscripcioneController::class, 'createEstudiante'])->name('admin.inscripciones.createEstudiante');
    Route::get('/inscripciones/{cedula}/{codigo}', [InscripcioneController::class, 'planillapdf'])->name('admin.inscripciones.pdf');
    Route::put('/inscripciones/{inscripcione}', [InscripcioneController::class, 'reset'])->name('admin.inscripciones.reset');
    Route::put('/inscripciones/update/observacion/{inscripcione}', [InscripcioneController::class, 'updateObservacion'])->name('admin.update.observacion');

    Route::resource('/inscripciones', InscripcioneController::class)->names('admin.inscripciones');
    Route::resource('/notas', NotaController::class)->names('admin.notas');

    /** Rutas del modulo de preinscripcion */
    Route::resource('preinscripciones', PreinscripcioneController::class)->names('admin.preinscripciones');
    
    /** Rutas de Concepto de estudiantes */
    Route::resource('/conceptos', ConceptoController::class)->names('admin.conceptos');
    
});
