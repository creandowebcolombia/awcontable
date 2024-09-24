<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $inventories = Inventory::all();
        return view('inventories.index', compact('inventories'));
    }

    // Mostrar formulario para crear un nuevo producto
    public function create()
    {
        return view('inventories.create');
    }

    // Guardar el nuevo producto en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Inventory::create($request->all());

        return redirect()->route('inventories.index')->with('success', 'Producto creado exitosamente');
    }

    // Mostrar formulario para editar un producto existente
    public function edit(Inventory $inventory)
    {
        return view('inventories.edit', compact('inventory'));
    }

    // Actualizar el producto en la base de datos
    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $inventory->update($request->all());

        return redirect()->route('inventories.index')->with('success', 'Producto actualizado exitosamente');
    }

    // Eliminar un producto
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Producto eliminado exitosamente');
    }

    // Exportar inventarios a Excel
    public function exportProducts()
    {
        return Excel::download(new ProductsExport, 'productos.xlsx');
    }

    // Importar productos desde Excel
    public function importProducts(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new ProductsImport, $request->file('file')->store('temp'));

        return redirect()->back()->with('success', 'Productos importados correctamente.');
    }
}
