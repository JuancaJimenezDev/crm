<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Venta;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SalesReportExport;
use App\Exports\SalesReportHeadersExport;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $clientes = Cliente::all();
        $vendedores = User::all();

        $reports = Venta::with(['cliente', 'user', 'detalles.producto']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $reports->whereBetween('fecha_venta', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('cliente_id')) {
            $reports->where('cliente_id', $request->cliente_id);
        }

        if ($request->filled('vendedor_id')) {
            $reports->where('user_id', $request->vendedor_id);
        }

        $reports = $reports->get();

        return view('sales_reports.index', compact('reports', 'clientes', 'vendedores'));
    }

    // Exportar todos los encabezados con sus detalles
    public function exportExcel(Request $request)
    {
        return Excel::download(new SalesReportExport($request), 'sales_report.xlsx');
    }


    public function exportSinglePDF($id)
    {
        // Buscar la venta con sus relaciones
        $report = Venta::with(['cliente', 'user', 'detalles.producto'])->findOrFail($id);

        // Generar el PDF con una sola venta
        $pdf = Pdf::loadView('sales_reports.single_pdf', compact('report'));

        // Descargar el archivo PDF
        return $pdf->download('venta_'.$id.'.pdf');
    }

    public function exportAllPDF(Request $request)
    {
        // Inicializamos la consulta para obtener las ventas con cliente, usuario y detalles
        $query = Venta::with(['cliente', 'user', 'detalles.producto']);

        // Aplicamos los filtros si los hay
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('fecha_venta', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('cliente_id')) {
            $query->where('cliente_id', $request->cliente_id);
        }

        if ($request->filled('vendedor_id')) {
            $query->where('user_id', $request->vendedor_id);
        }

        // Obtenemos todas las ventas aplicando los filtros
        $reports = $query->get();

        // Generar el PDF con todas las ventas filtradas
        $pdf = PDF::loadView('sales_reports.all_pdf', compact('reports'));

        // Descargar el archivo PDF
        return $pdf->download('reporte_de_ventas.pdf');
    }

}
