<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">

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
                    <h1 class="text-center text-light">Enviar Promociones</h1>
                </div>
                <div class="card-body">

                    <form action="{{ route('promociones.enviar') }}" method="POST">
                        @csrf

                        <h3>Selecciona Productos en Promoción:</h3>
                        @if($productos->isEmpty())
                            <div class="alert alert-warning">
                                No hay productos en promoción disponibles.
                                <br>
                                <br>
                                <a href="{{ route('productos.create') }}" class="btn btn-warning btn-sm">Agregar Productos</a>
                            </div>
                        @else
                            <div class="mb-2">
                                <input type="checkbox" id="select-all-products">
                                <label for="select-all-products">Seleccionar Todos los Productos</label>
                            </div>
                            <div class="list-group list-group-flush" style="max-height: 200px; overflow-y: auto;">
                                @foreach($productos as $producto)
                                    <div class="list-group-item">
                                        <input type="checkbox"
                                               class="product-checkbox"
                                               name="productos[]"
                                               value="{{ $producto->id }}">
                                        <span class="ml-4">
                                            {{ $producto->nombre }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <h3 class="mt-3">Selecciona Clientes:</h3>
                        @if($clientes->isEmpty())
                            <div class="alert alert-warning">
                                No hay clientes disponibles.
                                <br>
                                <br>
                                <a href="{{ route('clientes.create') }}" class="btn btn-warning btn-sm">Agregar Clientes</a>
                            </div>
                        @else
                            <div class="mb-2">
                                <input type="checkbox" id="select-all-clients">
                                <label for="select-all-clients">Seleccionar Todos los Clientes</label>
                            </div>
                            <div class="list-group list-group-flush" style="max-height: 200px; overflow-y: auto;">
                                @foreach($clientes as $cliente)
                                    <div class="list-group-item">
                                        <input type="checkbox"
                                               class="client-checkbox"
                                               name="clientes[]"
                                               value="{{ $cliente->id }}">
                                        <span class="ml-4">
                                            {{ $cliente->first_name }} {{ $cliente->last_name }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary mt-3" @if($productos->isEmpty() || $clientes->isEmpty()) disabled @endif>Enviar Promociones</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('select-all-products').addEventListener('change', function() {
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            productCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        document.getElementById('select-all-clients').addEventListener('change', function() {
            const clientCheckboxes = document.querySelectorAll('.client-checkbox');
            clientCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    </script>
</x-app-layout>
