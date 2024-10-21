<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">{{__('inventory.new_inventory')}}</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('inventario.store') }}">
                        @csrf

                        <!-- Producto -->
                        <div class="mb-3">
                            <x-input-label for="product_id" :value="__('inventory.product_name')" />
                            <select id="product_id" class="form-control" name="product_id" required>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                        </div>

                        <!-- Stock -->
                        <div class="mb-3">
                            <x-input-label for="stock" :value="__('inventory.stock')" />
                            <x-text-input id="stock" class="form-control" type="number" name="stock" required />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>


                        <div class="d-flex justify-content-end mt-4">
                            <x-a-ref linkRef="{{ route('inventario.index') }}">
                                {{ __('inventory.back') }}
                            </x-a-ref>
                            <x-primary-button>
                                {{ __('inventory.save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
