<?php

use App\Http\Controllers\InventoryController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas CRUD de inventarios
Route::resource('inventories', InventoryController::class);

// Ruta para exportar e importar productos
Route::get('inventories/export/excel', [InventoryController::class, 'exportProducts'])->name('inventories.export');
Route::post('inventories/import', [InventoryController::class, 'importProducts'])->name('inventories.import');
