<?php

namespace App\Http\Controllers;

use App\Mail\CorreoPromocional;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Promocion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PromocionController extends Controller
{
    public function index()
    {
        $productos = Producto::where('en_promocion', true)->get();
        $clientes = Cliente::all();
        return view('promociones.index', compact('productos', 'clientes'));
    }

    public function enviarPromociones(Request $request)
    {
        $productos = $request->input('productos');
        $clientes = $request->input('clientes');

        foreach ($clientes as $clienteId) {
            foreach ($productos as $productoId) {
                // Lógica para enviar el correo
                $cliente = Cliente::find($clienteId);
                $producto = Producto::find($productoId);

                Mail::to($cliente->email)->send(new CorreoPromocional($producto));

                // Guardar en la tabla de promociones
                Promocion::create([
                    'producto_id' => $productoId,
                    'cliente_id' => $clienteId,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Promociones enviadas con éxito.');
    }
}
