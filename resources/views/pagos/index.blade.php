<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <a title="{{__('pay.new_pay_method')}}" href="{{ route('pagos.create') }}" class="btn btn-success my-3">
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
                    <h1 class="text-center text-light">{{__('pay.pay_methods')}}</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="payment-methods-table" class="table table-striped table-bordered mt-4">
                            <thead>
                            <tr>
                                <th>{{ __('pay.name_pay_method') }}</th>
                                <th>{{ __('pay.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pagos as $pago)
                                <tr>
                                    <td>{{ $pago->metodo_pago }}</td>
                                    <td>
                                        <a title="{{__('pay.edit')}}" href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-link text-success">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger" title="{{__('pay.delete')}}">
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
