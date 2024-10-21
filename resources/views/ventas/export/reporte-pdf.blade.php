<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<h2>Reporte de Ventas</h2>

<table>
    <thead>
    <tr>
        <th>Nombre del Cliente</th>
        <th>Nombre del Vendedor</th>
        <th>Fecha de Venta</th>
        <th>Productos Vendidos</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Subtotal</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ventas as $venta)
        @foreach($venta->detalles as $detalle)
            <tr>
                <td>{{ $venta->cliente->nombre }}</td>
                <td>{{ $venta->user->name }}</td>
                <td>{{ $venta->fecha_venta }}</td>
                <td>{{ $detalle->producto->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>{{ number_format($detalle->precio_unitario, 2) }}</td>
                <td>{{ number_format($detalle->subtotal, 2) }}</td>
                <td>{{ number_format($venta->gran_total, 2) }}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
</body>
</html>
