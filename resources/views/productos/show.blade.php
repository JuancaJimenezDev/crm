<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">Detalles del Producto</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>{{ __('Nombre:') }}</strong> {{ $producto->nombre }}
                    </div>
                    <div class="mb-3">
                        <strong>{{ __('Stock:') }}</strong> {{ $producto->stock }}
                    </div>
                    <div class="mb-3">
                        <strong>{{ __('Fecha de Vencimiento:') }}</strong> {{ \Carbon\Carbon::parse($producto->fecha_vencimiento)->format('d/m/Y') }}
                    </div>
                    <div class="mb-3">
                        <strong>{{ __('Categoría:') }}</strong> {{ $producto->categoria->nombre }}
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('productos.index') }}" class="btn btn-secondary me-2">Regresar</a>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
