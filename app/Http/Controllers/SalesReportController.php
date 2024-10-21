<?php

namespace App\Http\Controllers;

use App\Models\SalesReportView;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesReportExport;
use PDF;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = SalesReportView::query();

        // Filtros por fecha, cliente o empleado
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $reports->whereBetween('fecha_venta', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('cliente_id')) {
            $reports->where('cliente_id', $request->cliente_id);
        }

        if ($request->filled('vendedor_id')) {
            $reports->where('vendedor_id', $request->vendedor_id);
        }

        $reports = $reports->get();

        return view('sales_reports.index', compact('reports'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new SalesReportExport($request), 'sales_report.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $reports = SalesReportView::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $reports->whereBetween('fecha_venta', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('cliente_id')) {
            $reports->where('cliente_id', $request->cliente_id);
        }

        if ($request->filled('vendedor_id')) {
            $reports->where('vendedor_id', $request->vendedor_id);
        }

        $reports = $reports->get();

        $pdf = PDF::loadView('sales_reports.pdf', compact('reports'));
        return $pdf->download('sales_report.pdf');
    }
}
