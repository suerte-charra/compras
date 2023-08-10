<?php

use App\Http\Controllers\AdquisicionController;
use App\Http\Controllers\BuscarController;
use App\Http\Controllers\ClasificacionController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\FinancimientoController;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\PresupuestosController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UsuarioController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

Auth::routes(['register'=> false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::controller(UsuarioController::class)->group(function(){
    Route::get('/configuracion/{id}','cambioPassword')->name('cambioPassword')->middleware('auth');
    Route::post('/actulizar/usuario/{id}','actulizarDatos')->name('actuliozarDatos')->middleware('auth');
    Route::get('/usuarios/indice','indiceusuario')->name('indiceusuario')->middleware('auth');
    Route::post('/usuarios/agregar','agregarusuario')->name('agregarusuario')->middleware('auth');
    Route::get('/usuarios/baja/{id}','bajausuario')->name('bajausuario')->middleware('auth');
    Route::get('/contraseña/cambiar/{idusuario}', 'restablecePass')->name('restablecePass')->middleware('auth');
    Route::post('/usuario/update/info/{idusuario}', 'userUpdate')->name('userUpdate')->middleware('auth');
});
Route::controller(ClasificacionController::class)->group(function(){
    Route::get('/clasificaciones/indice','index')->name('indice')->middleware('auth');
    Route::post('/clasificacion/agregar','agregarclasificacion')->name('agregarclasificacion')->middleware('auth');
    Route::post('/clasificacion/actulizar/{id}','actulizarclasificacion')->name('actulizarclasificacion')->middleware('auth');
    Route::get('/clasificacion/baja/{id}','bajaclasificacion')->name('bajaclasificacion')->middleware('auth');
});
Route::controller(MedidaController::class)->group(function(){
    Route::get('/medidas/indice','indicemedida')->name('indicemedida')->middleware('auth');
    Route::post('/medida/agregar','agregarmedida')->name('agregarmedida')->middleware('auth');
    Route::post('/medida/actualizar/{id}','actualizarmedida')->name('actualizarmedida')->middleware('auth');
    Route::get('/medida/baja/{id}','bajamedida')->name('bajamedida')->middleware('auth');
});
Route::controller(FinancimientoController::class)->group(function(){
    // Route::get('/financimientos/indice','indicefinancimiento')->name('indicefinancimiento')->middleware('auth');
    Route::post('/financiamiento/agregar','agregarfinanciamiento')->name('agregarfinanciamiento')->middleware('auth');
    Route::post('/financiamiento/actualizar/{id}','actualizarfinanciamiento')->name('actualizarfinanciamiento')->middleware('auth');
    Route::get('/financiamiento/baja/{id}','bajafinanciamiento')->name('bajafinanciamiento')->middleware('auth');
    Route::post('/presupuestos/importar', 'importarPresupuestos')->name('importarPresupuestos')->middleware('auth');
});
Route::controller(DependenciaController::class)->group(function(){
    Route::get('/dependencias/indice','indicedependencia')->name('indicedependencia')->middleware('auth');
    Route::post('/dependencia/agregar','agregardependencia')->name('agregardependencia')->middleware('auth');
    Route::post('/dependencia/actualizar/{id}','actulizardependencia')->name('actulizardependencia')->middleware('auth');
    Route::get('/dependencia/baja/{id}','bajadependencia')->name('bajadependencia')->middleware('auth');
});
Route::controller(AdquisicionController::class)->group(function(){
    Route::get('/adquisiciones/indice','index')->name('indiceadquisiciones')->middleware('auth');
    Route::get('/adquisiciones/aprobadas','indexaprobadas')->name('indexaprobadas')->middleware('auth');
    Route::get('/adquisiciones/aceptadas', 'indexaceptadas')->name('indexaceptadas')->middleware('auth');
    Route::get('/adquisiciones/rechazadas','indexrechazadas')->name('indexrechazadas')->middleware('auth');
    Route::post('/adquisicion/agregar','agregaradquisicion')->name('agregaradquisicion')->middleware('auth');
    Route::post('/adquisicion/actualizar/{id}','actualizaradquisicion')->name('actualizaradquisicion')->middleware('auth');
    Route::post('/adquisicion/ingreso','agregaradquisicion')->name('ingresoadqui')->middleware('auth');
    Route::post('/adquisicion/observacion/{id}','observacionadqui')->name('observacionadqui')->middleware('auth');
    Route::get('/adquisiciones/almacen/espera', 'almacenespera')->name('almacenespera')->middleware('auth');
    Route::get('/adquisiciones/almacen/dentro','enalmacen')->name('enalmacen')->middleware('auth');
    Route::get('/adquisiciones/almacen/entregado','almancenentregada')->name('almancenentregada')->middleware('auth');
    //Route::post('/adquisicion/cambioadqui/{id}','camadquiestatus')->name('camadquiestatus')->middleware('auth');
});
Route::controller(MovimientoController::class)->group(function(){
    Route::get('/movimientos/indice','index')->name('indicemov')->middleware('auth');
    Route::post('/movimientos/resultados','bmov')->name('buscarmov')->middleware('auth');
});

Route::controller(ProveedorController::class)->group(function(){
    Route::get('/proveedores/indice','indiceproveedor')->name('indiceproveedor')->middleware('auth');
    Route::post('proveedor/agregar','agregarproveedor')->name('agregarproveedor')->middleware('auth');
    Route::get('/proveedor/baja/{id}','bajaproveedor')->name('bajaproveedor')->middleware('auth');
});

Route::controller(BuscarController::class)->group(function(){
    Route::get('/buscar', 'buscar')->name('buscar')->middleware('auth');
    Route::post('/buscar/folio', 'buscarFolio')->name('buscarFolio')->middleware('auth');
    Route::post('/busqueda/actualizar/{folio}', 'actualizarFolio')->name('actualizarFolio')->middleware('auth');
});

Route::controller(PresupuestosController::class)->group(function () {
    Route::get('/presupuestos', 'inicioPresu')->name('inicioPresu')->middleware('auth');
});