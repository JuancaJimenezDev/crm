<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h1 class="text-center text-light">{{__('customer.customer_details')}}</h1>
                </div>
                <div class="list-group list-group-flush mt-5">
                    <div class="list-group-item">
                        <strong>{{ __('customer.first_name') }}: </strong> {{ $cliente->first_name }}
                    </div>
                    <div class="list-group-item">
                        <strong>{{ __('customer.last_name') }}: </strong> {{ $cliente->last_name }}
                    </div>
                    <div class="list-group-item">
                        <strong>{{ __('customer.phone') }}: </strong> {{ $cliente->phone_number }}
                    </div>
                    <div class="list-group-item">
                        <strong>{{ __('customer.address') }}: </strong> {{ $cliente->address }}
                    </div>
                    <div class="list-group-item">
                        <strong>{{ __('customer.address') }}: </strong> {{ $cliente->email }}
                    </div>
                    <div class="list-group-item">
                        <strong>{{ __('customer.nit') }}: </strong> {{ $cliente->nit }}
                    </div>

                    <div class="list-group-item">
                    <div class="d-flex justify-content-end mt-5 mb-4">
                        <x-a-ref linkRef="{{ route('clientes.index') }}">
                            {{ __('customer.back') }}
                        </x-a-ref>
                        <x-primary-button>
                            {{__('customer.edit')}}
                        </x-primary-button>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
