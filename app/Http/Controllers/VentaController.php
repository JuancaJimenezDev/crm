<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use App\Models\Inventory;
use App\Models\Pago;
use App\Models\User;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente', 'user')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $inventarios = Inventory::with('producto')->get();
        $productos = Producto::all();
        $pagos = Pago::all();
        return view('ventas.create', compact('clientes', 'productos', 'pagos', 'inventarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:cliente,id',
            'pago_id' => 'required|exists:pagos,id',
            'productos' => 'required|array',
            'productos.*.id' => 'exists:productos,id',
            'productos.*.cantidad' => 'integer|min:1',
        ]);

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Crear la venta inicialmente con subtotal y gran total en 0
            $venta = Venta::create([
                'user_id' => Auth::id(),
                'cliente_id' => $request->cliente_id,
                'pago_id' => $request->pago_id,
                'fecha_venta' => now(),
                'subtotal' => 0, // Se calculará después
                'gran_total' => 0, // Se calculará después
            ]);

            $subtotal = 0;

            // Verificar stock de todos los productos antes de registrar la venta
            foreach ($request->productos as $index => $prod) {
                $productoId = $prod['id'];
                $cantidad = $request->productos[$index]['cantidad'];

                // Verificar el inventario de cada producto
                $inventario = Inventory::where('product_id', $productoId)->first();
                $producto = Producto::find($productoId);

                if ($inventario->stock < $cantidad) {
                    // Si no hay suficiente stock para algún producto, hacemos rollback y mostramos el error
                    return redirect()->back()->withErrors(['error' => 'No hay suficiente stock para el producto: ' . $producto->nombre]);
                }
            }

            // Si hay stock suficiente para todos los productos, proceder con la creación de la venta
            foreach ($request->productos as $index => $prod) {
                $productoId = $prod['id'];
                $cantidad = $request->productos[$index]['cantidad'];

                // Obtener el inventario y producto
                $inventario = Inventory::where('product_id', $productoId)->first();
                $producto = Producto::find($productoId);

                // Calcular el precio
                $precio = $producto->en_promocion ? $producto->precio_promocional : $producto->precio;
                $subtotal_producto = $precio * $cantidad;

                // Crear el detalle de la venta
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'en_promocion' => $producto->en_promocion,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio,
                    'subtotal' => $subtotal_producto,
                ]);

                $subtotal += $subtotal_producto;

                // Actualizar el stock del inventario
                $inventario->stock -= $cantidad;
                $inventario->save();
            }

            // Actualizar los totales de la venta
            $venta->subtotal = $subtotal;
            $venta->gran_total = $subtotal; // Agregar impuestos o descuentos si es necesario
            $venta->save();

            // Confirmar la transacción
            DB::commit();

            return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');

        } catch (\Exception $e) {
            // En caso de error, revertir la transacción
            DB::rollBack();
            return redirect()->route('ventas.create')->withErrors(['error' => 'Error al registrar la venta. Inténtelo de nuevo.']);
        }
    }

    public function show(Venta $venta)
    {
        $venta->load('detalles.producto', 'cliente', 'user');
        return view('ventas.show', compact('venta'));
    }

    private function obtenerVentasFiltradas(Request $request)
    {
        $query = Venta::query()->with('detalles.producto', 'cliente', 'user');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('fecha_venta', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('cliente_id')) {
            $query->where('cliente_id', $request->cliente_id);
        }

        return $query->limit(30)->get();
    }

    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada.');
    }
}
