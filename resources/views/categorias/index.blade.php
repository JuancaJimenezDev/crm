<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <a title="{{__('category.new_category')}}" href="{{ route('categorias.create') }}" class="btn btn-success my-3">
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
                    <h1 class="text-center text-light">{{__('category.categories')}}</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="categories-table" class="table table-striped table-bordered mt-4">
                        <thead>
                        <tr>
                            <th>{{__('category.name')}}</th>
                            <th>{{__('category.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->nombre }}</td>
                                <td>
                                    <a title="{{__('category.show')}}" href="{{ route('categorias.show', $categoria->id) }}" class="btn btn-link text-success">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a title="{{__('category.edit')}}" href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-link text-success">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger" title="{{__('category.delete')}}">
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
        $('#categories-table').DataTable({
            language: allLanguage
        });
        $("#categories-table_filter input[type='search']").attr("style", "border-radius: 5px !important;");
        $("#categories-table_length").css("cssText", "margin-bottom: 20px !important;");
        $("#categories-table_length select").attr("style", "border-radius: 5px !important;");
        $("#categories-table_filter").css("cssText", "margin-bottom: 10px !important;");
        $("#categories-table_info").css("cssText", "margin-bottom: 10px !important;");
        $("#categories_paginate").css("cssText", "margin-bottom: 30px !important;");
    });
</script>
