<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

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
            'product_name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
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
            'product_name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
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
}
