<x-app-layout>
    <div class="container-fluid ">
        <div class="container my-4">

            <a title="{{__('customer.new_customer')}}" href="{{ route('clientes.create') }}" class="btn btn-success my-3">
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
                   <h1 class="text-center text-light"> {{__('customer.customers')}}</h1>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="clients-table" class="table table-striped table-bordered mt-4">
                            <thead>
                            <tr>
                                <th>{{__('customer.name')}}</th>
                                <th>{{__('customer.phone')}}</th>
                                <th>{{__('customer.address')}}</th>
                                <th class="d-none d-md-table-cell">{{__('customer.email')}}</th>
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
                                    <td class="d-none d-md-table-cell">{{ $cliente->email }}</td>
                                    <td>{{ $cliente->nit }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
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
                                        </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Inicializa DataTables -->
    <script>
        const allLanguage = {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Resultados",
            "infoEmpty": "Mostrando 0 to 0 of 0 Resultados",
            "infoFiltered": "(Filtrado de _MAX_ total resultados)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Resultados",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        };
        $(document).ready(function() {
            $('#clients-table').DataTable({
                language: allLanguage
            });
            $("#clients-table_filter input[type='search']").attr("style", "border-radius: 5px !important;");
            $("#clients-table_length").css("cssText", "margin-bottom: 20px !important;");
            $("#clients-table_length select").attr("style", "border-radius: 5px !important;");
            $("#clients-table_filter").css("cssText", "margin-bottom: 10px !important;");
            $("#clients-table_info").css("cssText", "margin-bottom: 10px !important;");
            $("#clients-table_paginate").css("cssText", "margin-bottom: 30px !important;");
        });
    </script>

</x-app-layout>
