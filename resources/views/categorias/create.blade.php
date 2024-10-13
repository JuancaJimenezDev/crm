<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">Nuevo Producto</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('productos.store') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <x-input-label for="nombre" :value="__('Nombre')" />
                            <x-text-input id="nombre" class="form-control" type="text" name="nombre" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <!-- Stock -->
                        <div class="mb-3">
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input id="stock" class="form-control" type="number" name="stock" required />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>

                        <!-- Fecha de Vencimiento -->
                        <div class="mb-3">
                            <x-input-label for="fecha_vencimiento" :value="__('Fecha de Vencimiento')" />
                            <x-text-input id="fecha_vencimiento" class="form-control" type="date" name="fecha_vencimiento" required />
                            <x-input-error :messages="$errors->get('fecha_vencimiento')" class="mt-2" />
                        </div>

                        <!-- ID Categoria -->
                        <div class="mb-3">
                            <x-input-label for="id_categoria" :value="__('ID Categoria')" />
                            <x-text-input id="id_categoria" class="form-control" type="number" name="id_categoria" required />
                            <x-input-error :messages="$errors->get('id_categoria')" class="mt-2" />
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <x-a-ref linkRef="{{ route('productos.index') }}">
                                {{ __('Regresar') }}
                            </x-a-ref>
                            <x-primary-button>
                                {{ __('Guardar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
