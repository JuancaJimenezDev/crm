<x-app-layout>
    <div class="container-fluid">

        {{-- Formulario de Filtros --}}
        <form action="{{ route('sales-reports.index') }}" method="GET" class="d-flex justify-content-center mt-3 mb-4">
           <div class="container-fluid bg-amber-950">
               <div class="row">
                   <div class="col">
                       <label for="start_date"><strong>{{ __('Fecha Inicio') }}</strong></label>
                       <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                   </div>
                   <div class="col">
                       <label for="end_date"><strong>{{ __('Fecha Fin') }}</strong></label>
                       <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                   </div>
               </div>
               <div class="row mt-3">
                   <div class="col">
                       <label for="cliente_id"><strong>{{ __('Cliente') }}</strong></label>
                       <select name="cliente_id" class="form-control">
                           <option value="">{{ __('Todos los clientes') }}</option>
                           @foreach($clientes as $cliente)
                               <option value="{{ $cliente->id }}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                   {{ $cliente->first_name }} {{ $cliente->last_name }}
                               </option>
                           @endforeach
                       </select>
                   </div>
                   <div class="col">
                       <label for="vendedor_id"><strong>{{ __('Vendedor') }}</strong></label>
                       <select name="vendedor_id" class="form-control">
                           <option value="">{{ __('Todos los vendedores') }}</option>
                           @foreach($vendedores as $vendedor)
                               <option value="{{ $vendedor->id }}" {{ request('vendedor_id') == $vendedor->id ? 'selected' : '' }}>
                                   {{ $vendedor->name }}
                               </option>
                           @endforeach
                       </select>
                   </div>
               </div>
               <div class="d-flex justify-content-center mt-5 mb-4">
                   <x-primary-button>
                       {{ __('Buscar') }}
                   </x-primary-button>
                   <x-a-ref linkRef="{{ route('sales-reports.index') }}">
                       {{ __('Limpiar') }}
                   </x-a-ref>
               </div>
           </div>

        </form>

        {{-- Tabla de Resultados --}}
        <div class="table-responsive">

            <table class="table table-striped table-bordered">
                <thead>
                <tr class="bg-success text-light text-center" style="border: 1px solid #198754">
                    <th class="bg-success text-light text-center" style="font-size: 20px; border: 1px solid #198754" colspan="6">{{ __('Reporte de Ventas') }}</th>
                </tr>
                <tr>
                    <th>{{ __('ID Venta') }}</th>
                    <th>{{ __('Cliente') }}</th>
                    <th>{{ __('Vendedor') }}</th>
                    <th>{{ __('Fecha de Venta') }}</th>
                    <th>{{ __('Gran Total') }}</th>
                    <th>{{ __('Acciones') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->cliente->first_name }} {{ $report->cliente->last_name }}</td>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ $report->fecha_venta }}</td>
                        <td>Q. {{ number_format($report->gran_total, 2, '.', ',') }}</td>
                        <td>
                            {{-- Botón para ver detalles con ícono Font Awesome --}}
                            <button class="btn btn-link text-success" onclick="toggleDetails({{ $report->id }})">
                                <i class="fas fa-eye"></i> {{-- Ícono para ver detalles --}}
                            </button>


                        </td>
                    </tr>
                    <tr id="details-{{ $report->id }}" style="display: none;">
                        <td colspan="6">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Producto') }}</th>
                                        <th>{{ __('Cantidad') }}</th>
                                        <th>{{ __('Precio Unitario') }}</th>
                                        <th>{{ __('Subtotal') }}</th>
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- Botones de Exportar --}}
        <div class="mt-4 mb-4">
            <a href="{{ route('sales-reports.exportExcel', request()->all()) }}" class="btn btn-success">
                <i class="fas fa-file-excel"></i> {{ __('Exportar a Excel') }}
            </a>
            <a href="{{ route('sales-reports.exportAllPDF', request()->all()) }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> {{ __('Exportar a PDF') }}
            </a>
        </div>


    </div>

    <script>
        function toggleDetails(id) {
            var row = document.getElementById('details-' + id);
            if (row.style.display === 'none') {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        }
    </script>
</x-app-layout>
