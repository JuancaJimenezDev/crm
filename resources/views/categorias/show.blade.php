<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">Detalles de la Categoría</h2>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush mt-5">
                        <div class="list-group-item">
                        <strong>{{ __('Nombre:') }}</strong> {{ $categoria->nombre }}
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex justify-content-end mt-5 mb-4">
                                <a href="{{ route('categorias.index') }}" class="btn btn-secondary me-2">Regresar</a>
                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary">Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
