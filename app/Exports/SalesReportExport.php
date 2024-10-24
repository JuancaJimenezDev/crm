<?php

namespace App\Exports;

use App\Models\Venta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesReportExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $request;
    protected $ventas; // Declaramos la propiedad ventas

    // Recibe la solicitud para aplicar los filtros
    public function __construct($request)
    {
        $this->request = $request;

        // Inicializamos la consulta para obtener las ventas con cliente, usuario y detalles
        $query = Venta::with(['cliente', 'user', 'detalles.producto']);

        // Aplicamos los filtros si los hay
        if ($this->request->filled('start_date') && $this->request->filled('end_date')) {
            $query->whereBetween('fecha_venta', [$this->request->start_date, $this->request->end_date]);
        }

        if ($this->request->filled('cliente_id')) {
            $query->where('cliente_id', $this->request->cliente_id);
        }

        if ($this->request->filled('vendedor_id')) {
            $query->where('user_id', $this->request->vendedor_id);
        }

        // Obtenemos todas las ventas y las guardamos en la propiedad ventas
        $this->ventas = $query->get(); // Aquí almacenamos las ventas
    }

    public function view(): View
    {
        // Retornamos la vista con las ventas
        return view('sales_reports.full_excel', [
            'ventas' => $this->ventas
        ]);
    }

    public function styles(Worksheet $sheet)
    {

        // Aplicar estilos al título
        $sheet->getStyle('A2:E2')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'size' => 18], // Negrita y tamaño de letra grande
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER], // Centrar texto
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF006400'], // Fondo verde oscuro para el título
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'], // Bordes finos para el encabezado
                ],
            ],
        ]);

        // Comenzar en la segunda fila (después del título)
        $rowCounter = 4; // Empezamos en la tercera fila para los encabezados de ventas

        // Recorremos todas las ventas y aplicamos estilos a los encabezados y detalles
        foreach ($this->ventas as $venta) {
            // Aplicar estilo al encabezado de la venta (verde oscuro)
            $sheet->getStyle('A' . $rowCounter . ':E' . $rowCounter)->applyFromArray([
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'],],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF28a745'], // Verde oscuro para el encabezado de la venta
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'], // Bordes finos para el encabezado
                    ],
                ],
            ]);

            // Aplicar los datos de la venta en la fila siguiente
            $sheet->getStyle('A' . ($rowCounter + 1) . ':E' . ($rowCounter + 1))->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'], // Bordes finos para los datos del encabezado
                    ],
                ],
            ]);

            $rowCounter += 2; // Mover a la fila del encabezado de detalles

            // Aplicar encabezado de detalles (verde claro)
            $sheet->getStyle('A' . $rowCounter . ':E' . $rowCounter)->applyFromArray([
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF90EE90'], // Verde claro para el encabezado de los detalles
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'], // Bordes finos
                    ],
                ],
            ]);

            $rowCounter += 1; // Siguiente fila para los detalles

            // Recorremos los detalles de la venta
            foreach ($venta->detalles as $detalle) {
                $sheet->getStyle('A' . $rowCounter . ':E' . $rowCounter)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'], // Bordes finos para los detalles
                        ],
                    ],
                ]);

                // Incrementar el contador de fila para cada detalle
                $rowCounter += 1;
            }

            // Agregar una fila vacía después de cada venta
            $rowCounter += 1;
        }

        return [];
    }

}
