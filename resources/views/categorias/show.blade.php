<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">{{__('category.details_category')}}</h2>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush mt-5">
                        <div class="list-group-item">
                        <strong>{{ __('category.name') }}: </strong> {{ $categoria->nombre }}
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex justify-content-end mt-5 mb-4">
                                <x-a-ref linkRef="{{ route('categorias.index') }}">
                                    {{ __('category.back') }}
                                </x-a-ref>
                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary">{{__('category.edit')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
