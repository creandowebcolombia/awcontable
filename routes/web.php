<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta principal que muestra la vista de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas para el módulo de inventarios (CRUD)
Route::resource('inventories', InventoryController::class);
