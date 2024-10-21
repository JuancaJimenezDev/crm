<x-app-layout>
    <div class="container my-4">
        <h2 class="text-center">{{ __('Reporte de Ventas') }}</h2>

        <!-- Formulario para filtrar por fechas -->
        <form method="GET" action="{{ route('ventas.reporte') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="start_date">{{ __('Fecha de Inicio') }}</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date">{{ __('Fecha de Fin') }}</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary mt-4">{{ __('Filtrar') }}</button>
                </div>
            </div>
        </form>

        <!-- Tabla de reporte -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>{{ __('Nombre del Cliente') }}</th>
                <th>{{ __('Nombre del Vendedor') }}</th>
                <th>{{ __('Fecha de Venta') }}</th>
                <th>{{ __('Productos Vendidos') }}</th>
                <th>{{ __('Cantidad') }}</th>
                <th>{{ __('Precio Unitario') }}</th>
                <th>{{ __('Subtotal') }}</th>
                <th>{{ __('Total') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->cliente_nombre }}</td>
                    <td>{{ $venta->vendedor_nombre }}</td>
                    <td>{{ $venta->fecha_venta }}</td>
                    <td>{{ $venta->producto_nombre }}</td>
                    <td>{{ $venta->cantidad }}</td>
                    <td>{{ number_format($venta->precio_unitario, 2) }}</td>
                    <td>{{ number_format($venta->subtotal, 2) }}</td>
                    <td>{{ number_format($venta->total, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
