<?php

namespace App\Exports;

use App\Models\Venta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class VentasExport implements FromView
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $ventas = (new \App\Http\Controllers\VentaController)->obtenerVentasFiltradas($this->request);
        return view('ventas.reporte-excel', ['ventas' => $ventas]);
    }
}
