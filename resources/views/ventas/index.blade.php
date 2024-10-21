<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <a title="{{__('sale.new_sale')}}" href="{{ route('ventas.create') }}" class="btn btn-success my-3">
                <i class="fas fa-plus"></i>
            </a>

            {{-- Alertas para mostrar si las promociones fueron enviadas o no --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header text-white">
                    <h1 class="text-center text-light">{{__('sale.sales_list')}}</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="sales-table" class="table table-striped table-bordered mt-4">
                            <thead>
                            <tr>
                                <th>{{__('sale.client_name')}}</th>
                                <th>{{__('sale.seller_name')}}</th>
                                <th>{{__('sale.sale_date')}}</th>
                                <th>{{__('sale.grand_total')}}</th>
                                <th>{{__('sale.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($ventas as $venta)
                                <tr>
                                    <td>{{ $venta->cliente->first_name }} {{$venta->cliente->last_name}}</td>
                                    <td>{{ $venta->user->name }}</td>
                                    <td>{{ $venta->fecha_venta }}</td>
                                    <td>Q. {{ number_format($venta->gran_total, 2, '.', ',')}}</td>
                                    <td>
                                        <a title="{{__('inventory.show')}}" href="{{ route('ventas.show', $venta->id) }}" class="btn btn-link text-success">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger" title="{{__('inventory.delete')}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
