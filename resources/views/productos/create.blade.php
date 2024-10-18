<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">{{__('product.add_product')}}</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('productos.store') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <x-input-label for="nombre" :value="__('product.name')" />
                            <x-text-input id="nombre" class="form-control" type="text" name="nombre" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <x-input-label for="precio" :value="__('product.price')" />
                            <x-text-input id="precio" class="form-control" type="number" step="0.01" name="precio" required />
                            <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                        </div>

                        <!-- En Promoción -->
                        <div class="mb-3">
                            <x-input-label for="en_promocion" :value="__('producto.in_promotion')" />
                            <select id="en_promocion" name="en_promocion" class="form-select" required>
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                            <x-input-error :messages="$errors->get('en_promocion')" class="mt-2" />
                        </div>

                        <!-- Precio Promocional -->
                        <div class="mb-3">
                            <x-input-label for="precio_promocional" :value="__('producto.price_promotion')" />
                            <x-text-input id="precio_promocional" class="form-control" type="number" step="0.01" name="precio_promocional" />
                            <x-input-error :messages="$errors->get('precio_promocional')" class="mt-2" />
                        </div>

                        <!-- Categoría -->
                        <div class="mb-3">
                            <x-input-label for="id_categoria" :value="__('product.category')" />
                            <select id="id_categoria" name="id_categoria" class="form-select" required>
                                <option value="" disabled selected>{{__('product.select_category')}}</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_categoria')" class="mt-2" />
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <x-a-ref linkRef="{{ route('productos.index') }}">
                                {{ __('product.back') }}
                            </x-a-ref>
                            <x-primary-button>
                                {{ __('product.save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
