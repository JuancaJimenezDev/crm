<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <a title="{{__('inventory.new_inventory')}}" href="{{ route('inventario.create') }}"
               class="btn btn-success my-3">
                <i class="fas fa-plus"></i>
            </a>

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
                    <h1 class="text-center text-light">{{__('inventory.inventory_list')}}</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="inventory-table" class="table table-striped table-bordered mt-4">
                            <thead>
                            <tr>
                                <th>{{__('inventory.product_name')}}</th>
                                <th>{{__('inventory.stock')}}</th>
                                <th>{{__('inventory.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($inventories as $inventario)
                                <tr>
                                    <td>{{ $inventario->producto->nombre }}</td> <!-- Muestra el nombre del producto -->
                                    <td>{{ $inventario->stock }}</td>
                                    <td>
                                        <a title="{{__('inventory.show')}}"
                                           href="{{ route('inventario.show', $inventario->id) }}"
                                           class="btn btn-link text-success">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a title="{{__('inventory.edit')}}"
                                           href="{{ route('inventario.edit', $inventario->id) }}"
                                           class="btn btn-link text-success">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('inventario.destroy', $inventario->id) }}" method="POST"
                                              class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger"
                                                    title="{{__('inventory.delete')}}">
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

