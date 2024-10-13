<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">Editar Producto</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('productos.update', $producto->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-3">
                            <x-input-label for="nombre" :value="__('Nombre')" />
                            <x-text-input id="nombre" class="form-control" type="text" name="nombre" value="{{ $producto->nombre }}" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <!-- Stock -->
                        <div class="mb-3">
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input id="stock" class="form-control" type="number" name="stock" value="{{ $producto->stock }}" required />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>

                        <!-- Fecha de Vencimiento -->
                        <div class="mb-3">
                            <x-input-label for="fecha_vencimiento" :value="__('Fecha de Vencimiento')" />
                            <x-text
