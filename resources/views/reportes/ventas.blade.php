<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">{{ __('Reportes de Ventas') }}</h2>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('reportes.ventas') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <x-input-label for="start_date" :value="__('Fecha de Inicio')" />
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <div class="col-md-4">
                                <x-input-label for="end_date" :value="__('Fecha de Fin')" />
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                            <div class="col-md-4">
                                <x-input-label for="cliente_id" :value="__('Cliente')" />
                                <input type="text" class="form-control" name="cliente_id" placeholder="Buscar por Cliente">
                            </div>
                            <div class="col-md-4">
                                <x-input-label for="vendedor_id" :value="__('Vendedor')" />
                                <input type="text" class="form-control" name="vendedor_id" placeholder="Buscar por Vendedor">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Buscar') }}</button>
                        </div>
                    </form>

                    <table class="table mt-4">
                        <thead>
                        <tr>
                            <th>{{ __('Nombre del Cliente') }}</th>
                            <th>{{ __('Nombre del Vendedor') }}</th>
                            <th>{{ __('Fecha de Venta') }}</th>
                            <th>{{ __('Productos Vendidos') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ventas as $venta)
                            <tr>
                                <td>{{ $venta->cliente_nombre }}</td>
                                <td>{{ $venta->vendedor_nombre }}</td>
                                <td>{{ $venta->fecha_venta }}</td>
                                <td>{{ $venta->productos_vendidos }}</td>
                                <td>{{ $venta->total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <form method="POST" action="{{ route('reportes.ventas.export') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <select name="file_type" class="form-control">
                                    <option value="excel">Excel</option>
                                    <option value="pdf">PDF</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">{{ __('Exportar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
