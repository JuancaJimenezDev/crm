<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta {{ $report->id }}</title>
    <style>
        /* Estilos básicos de Bootstrap 5.3 en línea */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .bg-success {
            background-color: #28a745 !important;
            color: white;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .text-white {
            color: #fff !important;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #28a745;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            color: white;
        }

        .card-body {
            padding: 1.25rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .h2 {
            font-size: 2rem;
        }

        /* Otros estilos personalizados */
        p {
            margin: 0;
            padding: 0.25rem 0;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="card mb-4">
    {{-- Encabezado de la venta --}}
    <div class="card-header bg-success text-white">
        <h2 class="card-title">Venta {{ $report->id }}</h2>
    </div>
    <div class="card-body">
        <p><strong>Cliente:</strong> {{ $report->cliente->first_name }} {{ $report->cliente->last_name }}</p>
        <p><strong>Vendedor:</strong> {{ $report->user->name }}</p>
        <p><strong>Fecha de Venta:</strong> {{ $report->fecha_venta }}</p>
        <p><strong>Gran Total:</strong> Q. {{ number_format($report->gran_total, 2, '.', ',') }}</p>

        {{-- Detalles de la venta --}}
        <table class="table table-bordered">
            <thead class="bg-light">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($report->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>Q. {{ number_format($detalle->precio_unitario, 2, '.', ',') }}</td>
                    <td>Q. {{ number_format($detalle->subtotal, 2, '.', ',') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
