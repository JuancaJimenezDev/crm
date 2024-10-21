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
