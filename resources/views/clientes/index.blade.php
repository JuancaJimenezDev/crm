<x-app-layout>
    <div class="container-fluid ">
        <div class="container my-4">

            <a title="{{__('customer.new_customer')}}" href="{{ route('clientes.create') }}" class="btn btn-success my-3">
                <i class="fas fa-plus"></i>
            </a>

            <div class="card">
                <div class="card-header text-white">
                   <h1 class="text-center text-light"> {{__('customer.customers')}}</h1>
                </div>
                <div class="card-body">
                    <!-- Incluye los estilos de DataTables -->
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
                    <!-- Incluye Font Awesome -->
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

                    <div class="table-responsive">
                        <table id="clients-table" class="table table-striped table-bordered mt-4">
                            <thead>
                            <tr>
                                <th>{{__('customer.name')}}</th>
                                <th>{{__('customer.phone')}}</th>
                                <th>{{__('customer.address')}}</th>
                                <th>{{__('customer.nit')}}</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->first_name }} {{ $cliente->last_name }}</td>
                                    <td>{{ $cliente->phone_number }}</td>
                                    <td>{{ $cliente->address }}</td>
                                    <td>{{ $cliente->nit }}</td>
                                    <td>
                                        <a title="{{__('customer.show')}}" href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-link text-success">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a title="{{__('customer.edit')}}" href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-link text-success">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger" title="{{__('customer.delete')}}">
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

    <!-- Incluye los scripts de DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Inicializa DataTables -->
    <script>
        $(document).ready(function() {
            $('#clients-table').DataTable();
        });
    </script>
</x-app-layout>
