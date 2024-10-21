<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">{{__('category.category_add')}}</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('categorias.store') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <x-input-label for="nombre" :value="__('category.name')" />
                            <x-text-input id="nombre" class="form-control" type="text" name="nombre" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>


                        <div class="d-flex justify-content-end mt-4">
                            <x-a-ref linkRef="{{ route('categorias.index') }}">
                                {{ __('category.back') }}
                            </x-a-ref>
                            <x-primary-button>
                                {{ __('category.save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
