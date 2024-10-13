<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <a title="Nueva categoría" href="{{ route('categorias.create') }}" class="btn btn-success my-3">
                <i class="fas fa-plus"></i>
            </a>

            <div class="card">
                <div class="card-header text-white">
                    <h1 class="text-center text-light">Categorías</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="categories-table" class="table table-striped table-bordered mt-4">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->nombre }}</td>
                                <td>
                                    <a title="Ver" href="{{ route('categorias.show', $categoria->id) }}" class="btn btn-link text-success">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a title="Editar" href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-link text-success">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline-block">
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
</x-app-layout>
