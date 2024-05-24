<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\CuotasController;
use App\Http\Controllers\PagoController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/socios', [SocioController::class, 'socios'])->name('socios');
Route::get('/crear-socio', [SocioController::class, 'crearSocio'])->name('crearSocio'); // Corregido
Route::get('/socios/{id}/editar', [SocioController::class, 'edit'])->name('socios.edit');
Route::put('/actualizar-socio/{id}', [SocioController::class, 'update'])->name('actualizar-socio');
Route::delete('/socios/{id}', [SocioController::class, 'eliminar'])->name('socios.eliminar');
Route::post('/guardar-socio', [SocioController::class, 'guardarSocio'])->name('guardarSocio');
Route::get('/cuotas', [CuotasController::class, 'cuotas'])->name('cuotas');
Route::post('/cuotas/{id}', [CuotasController::class, 'update'])->name('modificarCuota');
Route::get('/pagos/create', [PagoController::class, 'create'])->name('pagos.create');
Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');