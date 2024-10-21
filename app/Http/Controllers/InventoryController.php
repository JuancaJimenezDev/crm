<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Producto;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('producto')->get();
        return view('inventario.index', compact('inventories'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('inventario.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:productos,id',
            'stock' => 'required|integer',
        ]);

        Inventory::create([
            'product_id' => $request->product_id,
            'stock' => $request->stock,
            'added_by' => auth()->user()->id,
        ]);

        return redirect()->route('inventario.index')->with('success', __('Inventory created successfully'));
    }

    public function show(Inventory $inventario)
    {
        $inventario->load('producto');
        return view('inventario.show', compact('inventario'));
    }


    public function edit(Inventory $inventario)
    {
        $productos = Producto::all();
        return view('inventario.edit', compact('inventario', 'productos'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'product_id' => 'required|exists:productos,id',
            'stock' => 'required|integer',
        ]);

        $inventory->update([
            'product_id' => $request->product_id,
            'stock' => $request->stock,
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('inventario.index')->with('success', __('Inventory updated successfully'));
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventario.index')->with('success', __('Inventory deleted successfully'));
    }
}
