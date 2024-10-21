<?php

namespace App\Exports;

use App\Models\Venta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Venta::with('cliente', 'user', 'detalles.producto')
            ->whereBetween('fecha_venta', [$this->startDate, $this->endDate])
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nombre del Cliente',
            'Nombre del Vendedor',
            'Fecha de Venta',
            'Producto',
            'Cantidad',
            'Precio Unitario',
            'Subtotal',
            'Total'
        ];
    }

    public function map($venta): array
    {
        $ventasMapped = [];

        foreach ($venta->detalles as $detalle) {
            $ventasMapped[] = [
                $venta->cliente->nombre,
                $venta->user->name,
                $venta->fecha_venta,
                $detalle->producto->nombre,
                $detalle->cantidad,
                $detalle->precio_unitario,
                $detalle->subtotal,
                $venta->gran_total
            ];
        }

        return $ventasMapped;
    }
}
