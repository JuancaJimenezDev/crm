<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <a title="Nuevo producto" href="{{ route('productos.create') }}" class="btn btn-success my-3">
                <i class="fas fa-plus"></i>
            </a>

            <div class="card">
                <div class="card-header text-white">
                    <h1 class="text-center text-light"> Productos</h1>
                </div>
                <div class="card-body">
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

                    <div class="table-responsive">
                        <table id="products-table" class="table table-striped table-bordered mt-4">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>En Promoción</th>
                                <th>Precio Promocional</th>
                                <th>Categoría</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ number_format($producto->precio, 2) }}</td>
                                    <td>{{ $producto->en_promocion ? 'Sí' : 'No' }}</td>
                                    <td>{{ $producto->precio_promocional ? number_format($producto->precio_promocional, 2) : 'N/A' }}</td>
                                    <td>{{ $producto->categoria ? $producto->categoria->nombre : 'N/A' }}</td>
                                    <td>
                                        <a title="Ver" href="{{ route('productos.show', $producto->id) }}" class="btn btn-link text-success">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a title="Editar" href="{{ route('productos.edit', $producto->id) }}" class="btn btn-link text-success">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger" title="Eliminar">
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

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#products-table').DataTable();
        });
    </script>
</x-app-layout>
