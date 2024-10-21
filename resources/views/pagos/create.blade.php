<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">{{__('pay.create_payment_method')}}</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pagos.store') }}">
                        @csrf

                        <!-- Método de Pago -->
                        <div class="mb-3">
                            <x-input-label for="metodo_pago" :value="__('pay.name_pay_method')" />
                            <x-text-input id="metodo_pago" class="form-control" type="text" name="metodo_pago" required />
                            <x-input-error :messages="$errors->get('metodo_pago')" class="mt-2" />
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <x-a-ref linkRef="{{ route('pagos.index') }}">
                                {{ __('pay.back') }}
                            </x-a-ref>
                            <x-primary-button>
                                {{ __('pay.save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
