
<table class="table table-success table-striped table-bordered">
    <tbody>
    <tr>
        <td colspan="5"></td>
    </tr>
    <tr>
        <th colspan="5">Reporte de ventas</th>
    </tr>
    <tr>
        <td colspan="5"></td>
    </tr>
    @foreach ($ventas as $venta)
        {{-- Encabezado de la venta con verde mas oscuro --}}
        <tr>
            <th><strong>ID Venta</strong></th>
            <th><strong>Cliente</strong></th>
            <th><strong>Vendedor</strong></th>
            <th><strong>Fecha de Venta</strong></th>
            <th><strong>Gran Total</strong></th>
        </tr>
        {{-- todos los bordes --}}
        <tr>
            <td>{{ $venta->id }}</td>
            <td>{{ $venta->cliente->first_name }} {{ $venta->cliente->last_name }}</td>
            <td>{{ $venta->user->name }}</td>
            <td>{{ $venta->fecha_venta }}</td>
            <td>Q. {{ number_format($venta->gran_total, 2, '.', ',') }}</td>
        </tr>
        {{-- fin todos los bordes --}}
        {{-- fin encabezado verde oscuto--}}
        {{-- salto de linea en blanco --}}
        <tr>
            <th><strong>Producto</strong></th>
            <th><strong>Cantidad</strong></th>
            <th><strong>Precio Unitario</strong></th>
            <th colspan="2"><strong>Subtotal</strong></th>
        </tr>
        {{-- fin Encabezado de los detalles con verde mas claro --}}

        {{-- fin todos los bordes --}}
        @foreach ($venta->detalles as $detalle)
            <tr>
                <td>{{ $detalle->producto->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>Q. {{ number_format($detalle->precio_unitario, 2, '.', ',') }}</td>
                <td colspan="2">Q. {{ number_format($detalle->subtotal, 2, '.', ',') }}</td>
            </tr>


        @endforeach
        {{-- Línea vacía para separar ventas --}}
        <tr>
            <td colspan="5"></td>
        </tr>
        {{-- fin Línea vacía para separar ventas --}}
    @endforeach
    </tbody>
</table>
