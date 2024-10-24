<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@foreach ($reports as $report)
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
@endforeach
</body>
</html>
