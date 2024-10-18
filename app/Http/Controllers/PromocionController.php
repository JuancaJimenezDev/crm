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
        $productos = Producto::whereIn('id', $request->input('productos'))->get();
        $clientes = Cliente::whereIn('id', $request->input('clientes'))->get();

        foreach ($clientes as $cliente) {
            // Enviar todos los productos como array al correo del cliente
            Mail::to($cliente->email)->send(new CorreoPromocional($productos));

            // Guardar en la tabla de promociones para cada producto y cliente
            foreach ($productos as $producto) {
                Promocion::create([
                    'producto_id' => $producto->id,
                    'cliente_id' => $cliente->id,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Promociones enviadas con éxito.');
    }
}
