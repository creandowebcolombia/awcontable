<?php
use App\Http\Controllers\InventoryController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas CRUD de inventarios
Route::resource('inventories', InventoryController::class);
