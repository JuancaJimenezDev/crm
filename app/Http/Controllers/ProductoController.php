<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'fecha_vencimiento' => 'nullable|date',
            'id_categoria' => 'required|exists:categorias,id', // Validar que la categoría exista
        ]);

        Producto::create($request->all()); // Crear un nuevo producto

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show(Producto $producto)
    {
        // Cargar la categoría relacionada
        $producto->load('categoria');
        return view('productos.show', compact('producto'));
    }


    public function edit(Producto $producto)
    {
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'fecha_vencimiento' => 'required|date',
            'id_categoria' => 'required|exists:categorias,id', // Validar que la categoría exista
        ]);

        $producto->update($request->all()); // Actualizar el producto existente

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete(); // Eliminar el producto
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
