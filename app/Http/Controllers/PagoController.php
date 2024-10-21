<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    // Mostrar lista de métodos de pago
    public function index()
    {
        $pagos = Pago::all(); // Obtener todos los métodos de pago
        return view('pagos.index', compact('pagos'));
    }

    // Mostrar formulario para crear un nuevo método de pago
    public function create()
    {
        return view('pagos.create');
    }

    // Almacenar un nuevo método de pago en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'metodo_pago' => 'required|string|max:255',
        ]);

        Pago::create([
            'metodo_pago' => $request->metodo_pago,
        ]);

        return redirect()->route('pagos.index')->with('success', 'Método de pago creado exitosamente.');
    }


    // Mostrar formulario para editar un método de pago
    public function edit(Pago $pago)
    {
        return view('pagos.edit', compact('pago'));
    }

    // Actualizar un método de pago en la base de datos
    public function update(Request $request, Pago $pago)
    {
        $request->validate([
            'metodo_pago' => 'required|string|max:255',
        ]);

        $pago->update([
            'metodo_pago' => $request->metodo_pago,
        ]);

        return redirect()->route('pagos.index')->with('success', 'Método de pago actualizado exitosamente.');
    }

    // Eliminar un método de pago
    public function destroy(Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index')->with('success', 'Método de pago eliminado exitosamente.');
    }
}
