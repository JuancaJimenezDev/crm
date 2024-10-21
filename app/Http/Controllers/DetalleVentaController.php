<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index(Venta $venta)
    {
        $detalles = DetalleVenta::with('producto')->where('venta_id', $venta->id)->get();
        return view('ventas.detalle_ventas.index', compact('detalles', 'venta'));
    }


    public function store(Request $request, Venta $venta)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::find($request->producto_id);

        // Verificación de inventario
        if ($producto->stock < $request->cantidad) {
            return redirect()->back()->withErrors(['error' => 'No hay suficiente stock para el producto: ' . $producto->nombre]);
        }

        $precio = $producto->en_promocion ? $producto->precio_promocional : $producto->precio;
        $subtotal_producto = $precio * $request->cantidad;

        DetalleVenta::create([
            'venta_id' => $venta->id,
            'producto_id' => $producto->id,
            'en_promocion' => $producto->en_promocion,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $precio,
            'subtotal' => $subtotal_producto,
        ]);

        // Restar del inventario
        $producto->stock -= $request->cantidad;
        $producto->save();

        return redirect()->route('ventas.detalle_ventas.index', $venta->id)->with('success', 'Producto agregado a la venta.');
    }


    public function update(Request $request, DetalleVenta $detalleVenta)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::find($request->producto_id);

        // Verificación de inventario
        if ($producto->stock + $detalleVenta->cantidad < $request->cantidad) {
            return redirect()->back()->withErrors(['error' => 'No hay suficiente stock para el producto: ' . $producto->nombre]);
        }

        // Ajustar inventario
        $producto->stock += $detalleVenta->cantidad; // Devolver el stock original
        $producto->stock -= $request->cantidad; // Restar la nueva cantidad
        $producto->save();

        $precio = $producto->en_promocion ? $producto->precio_promocional : $producto->precio;
        $subtotal_producto = $precio * $request->cantidad;

        $detalleVenta->update([
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $precio,
            'subtotal' => $subtotal_producto,
        ]);

        return redirect()->route('ventas.detalle_ventas.index', $detalleVenta->venta_id)->with('success', 'Producto actualizado en la venta.');
    }

    public function destroy(DetalleVenta $detalleVenta)
    {
        // Devolver el stock al eliminar el detalle de venta
        $producto = $detalleVenta->producto;
        $producto->stock += $detalleVenta->cantidad;
        $producto->save();

        $detalleVenta->delete();

        return redirect()->route('ventas.detalle_ventas.index', $detalleVenta->venta_id)->with('success', 'Producto eliminado de la venta.');
    }
}
