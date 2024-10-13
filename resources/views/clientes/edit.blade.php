<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">

                <div class="card-header text-white">
                    <h2 class="text-center text-light">{{__('customer.edit_customer')}}</h2>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- First Name -->
                        <div class="mb-3">
                            <x-input-label for="first_name" :value="__('customer.first_name')" />
                            <x-text-input id="first_name" class="form-control" type="text" name="first_name" value="{{ $cliente->first_name }}" required autofocus />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <x-input-label for="last_name" :value="__('customer.last_name')" />
                            <x-text-input id="last_name" class="form-control" type="text" name="last_name" value="{{ $cliente->last_name }}" required />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <x-input-label for="phone_number" :value="__('customer.phone')" />
                            <x-text-input id="phone_number" class="form-control" type="text" name="phone_number" value="{{ $cliente->phone_number }}" required />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <x-input-label for="address" :value="__('customer.address')" />
                            <x-text-input id="address" class="form-control" type="text" name="address" value="{{ $cliente->address }}" required />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- NIT -->
                        <div class="mb-3">
                            <x-input-label for="nit" :value="__('customer.nit')" />
                            <x-text-input id="nit" class="form-control" type="text" name="nit" value="{{ $cliente->nit }}" required />
                            <x-input-error :messages="$errors->get('nit')" class="mt-2" />
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <x-a-ref linkRef="{{ route('clientes.index') }}">
                                {{ __('customer.back') }}
                            </x-a-ref>
                            <x-primary-button>
                                {{ __('customer.save') }}
                            </x-primary-button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
