<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">Detalles del Producto</h2>
                </div>
                <div class="list-group list-group-flush mt-5">
                    <div class="list-group-item">
                        <strong>{{ __('Nombre:') }}</strong> {{ $producto->nombre }}
                    </div>
                    <div class="list-group-item">
                        <strong>{{ __('Precio:') }}</strong> {{ number_format($producto->precio, 2) }} {{ __('USD') }}
                    </div>
                    <div class="list-group-item">
                        <strong>{{ __('En Promoción:') }}</strong> {{ $producto->en_promocion ? 'Sí' : 'No' }}
                    </div>
                    <div class="list-group-item">
                        <strong>{{ __('Precio Promocional:') }}</strong> {{ $producto->precio_promocional ? number_format($producto->precio_promocional, 2) : 'N/A' }} {{ __('USD') }}
                    </div>
                    <div class="list-group-item">
                        <strong>{{ __('Categoría:') }}</strong> {{ $producto->categoria ? $producto->categoria->nombre : 'N/A' }}
                    </div>

                    <div class="list-group-item">
                        <div class="d-flex justify-content-end mt-5 mb-4">
                            <a href="{{ route('productos.index') }}" class="btn btn-secondary me-2">Regresar</a>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
