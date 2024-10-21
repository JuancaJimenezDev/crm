<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">{{__('sale.sale_details')}}</h2>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush mt-5">
                        <div class="list-group-item">
                            <strong>{{ __('sale.client_name') }}: </strong> {{ $venta->cliente->first_name}} {{$venta->cliente->last_name}}
                        </div>
                        <div class="list-group-item">
                            <strong>{{ __('sale.seller_name') }}: </strong> {{ $venta->user->name }}
                        </div>
                        <div class="list-group-item">
                            <strong>{{ __('sale.sale_date') }}: </strong> {{ $venta->fecha_venta }}
                        </div>
                        <div class="list-group-item">
                            <strong>{{ __('sale.grand_total') }}: </strong> Q. {{ number_format($venta->gran_total, 2, '.', ',') }}
                        </div>

                        <div class="list-group-item">
                            <h4 style="font-size: 18px; font-weight: 800">{{ __('sale.products_sold') }}</h4>
                            <table class="table table-bordered border-success mt-4 mb-5">
                                <thead>
                                <tr>
                                    <th>{{ __('sale.product_name') }}</th>
                                    <th>{{ __('sale.quantity') }}</th>
                                    <th>{{ __('sale.unit_price') }}</th>
                                    <th>{{ __('sale.subtotal') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($venta->detalles as $detalle)
                                    <tr>
                                        <td>{{ $detalle->producto->nombre }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td> Q. {{ number_format($detalle->precio_unitario, 2, '.', ',') }}</td>
                                        <td> Q. {{ number_format($detalle->subtotal, 2, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex justify-content-end mt-5 mb-4">
                                <x-a-ref linkRef="{{ route('ventas.index') }}">
                                    {{ __('sale.back') }}
                                </x-a-ref>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
