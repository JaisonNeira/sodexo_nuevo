<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ResultadosController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\SedesController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\EncargadosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::get('/p', function () {
    return view('pdf');
});

Auth::routes();

Route::get('/home', [HomeController::class,'index'])->name('home');

Route::get('/resultados/recientes', [ResultadosController::class, 'index']);

Route::get('/calificaciones', [ResultadosController::class, 'tablaindex'])->name('tabla.index');
Route::get('/g/calificaciones', [ResultadosController::class, 'tabladatos'])->name('get.tabla.index');
Route::get('/ba/calificaciones', [ResultadosController::class, 'BusquedaAvanzada'])->name('busqueda.avanzada.tabla.index');
Route::get('/exportar', [ResultadosController::class, 'export'])->name('export.calificaciones');
Route::get('/calificacion/get', [ResultadosController::class, 'buscarDatosActualizar'])->name('caligicacion:get');
Route::put('/resultados/update', [ResultadosController::class, 'ActualizarDatos'])->name('update.resultado');
Route::get('/resultados/vermas', [ResultadosController::class, 'Ver_mas'])->name('ver.mas.resultado');
Route::get('/resultados/pdf/{id}', [ResultadosController::class, 'download_pdf'])->name('download.pdf');


Route::get('/gb/dashboard', [ResultadosController::class, 'graficaBarra'])->name('graficos.dashboard');
Route::get('/gc/dashboard', [ResultadosController::class, 'graficaCircular'])->name('graficos.dashboard');


/* Crud Roles */
Route::get('/roles', [RolController::class, 'index'])->name('indexRol');
Route::get('/rol/create', [RolController::class, 'create'])->name('GuardarRol');
Route::post('/rol/create', [RolController::class, 'store'])->name('StoreRol');
Route::delete('/roles/delete/{id}', [RolController::class, 'destroy'])->name('BorrarRol');
Route::get('/roles/update/{id}', [RolController::class, 'edit'])->name('EditarRol');
Route::patch('/roles/update/{id}', [RolController::class, 'update'])->name('UpdateRol');

/* Crud Users */
Route::get('/user', [UserController::class, 'index'])->name('indexUser');
Route::get('/user/create', [UserController::class, 'create'])->name('GuardarUser');
Route::post('/user/create', [UserController::class, 'store'])->name('StoreUser');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('BorrarUser');
Route::get('/user/update/{id}', [UserController::class, 'edit'])->name('EditarUser');
Route::patch('/user/update/{id}', [UserController::class, 'update'])->name('UpdateUser');

//EMPRESA
Route::get('/empresas', [EmpresasController::class, 'index'])->name('empresa.index');
Route::post('/empresas', [EmpresasController::class, 'create'])->name('empresa.create');
Route::delete('/empresas/delete/{id}', [EmpresasController::class, 'destroy'])->name('empresa.delete');
Route::put('/empresas/update/{id}', [EmpresasController::class, 'update'])->name('empresa.update');

//ENCARGADOS
Route::get('/encargados', [EncargadosController::class, 'index'])->name('encargado.index');
Route::post('/encargados', [EncargadosController::class, 'create'])->name('encargado.create');
Route::delete('/encargados/delete/{id}', [EncargadosController::class, 'destroy'])->name('encargado.delete');
Route::put('/encargados/update/{id}', [EncargadosController::class, 'update'])->name('encargado.update');

//SEDE
Route::get('/sedes', [SedesController::class, 'index'])->name('sede.index');
Route::post('/sedes', [SedesController::class, 'create'])->name('sede.create');
Route::delete('/sedes/delete/{id}', [SedesController::class, 'destroy'])->name('sede.delete');
Route::put('/sedes/update/{id}', [SedesController::class, 'update'])->name('sede.update');

//CURSO
Route::get('/cursos', [CursosController::class, 'index'])->name('curso.index');
Route::post('/cursos', [CursosController::class, 'create'])->name('curso.create');
Route::delete('/cursos/delete/{id}', [CursosController::class, 'destroy'])->name('curso.delete');
Route::put('/cursos/update/{id}', [CursosController::class, 'update'])->name('curso.update');

//EMPLEADOS
Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleado.index');
Route::post('/empleados', [EmpleadosController::class, 'create'])->name('empleado.create');
Route::delete('/empleados/delete/{id}', [EmpleadosController::class, 'destroy'])->name('empleado.delete');
Route::put('/empleados/update/{id}', [EmpleadosController::class, 'update'])->name('empleado.update');


