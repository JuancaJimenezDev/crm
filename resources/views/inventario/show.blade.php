<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">{{__('inventory.details_inventory')}}</h2>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush mt-5">
                        <div class="list-group-item">
                            <strong>{{ __('inventory.product_name') }}: </strong> {{ $inventario->producto->nombre}}


                        </div>
                        <div class="list-group-item">
                            <strong>{{ __('inventory.stock') }}: </strong> {{ $inventario->stock }}
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex justify-content-end mt-5 mb-4">
                                <x-a-ref linkRef="{{ route('inventario.index') }}">
                                    {{ __('inventory.back') }}
                                </x-a-ref>
                                <a href="{{ route('inventario.edit', $inventario->id) }}" class="btn btn-primary">{{__('inventory.edit')}}</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
