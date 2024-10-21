<x-app-layout>
    <div class="container-fluid">
        <div class="container my-4">
            <div class="card">
                <div class="card-header text-white">
                    <h2 class="text-center text-light">{{__('sale.create_sale')}}</h2>
                </div>

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



                <div class="card-body">

                    <div class="mt-2 mb-2" id="dynamic-error-alert"></div>

                    <form method="POST" action="{{ route('ventas.store') }}">
                        @csrf

                        <!-- Cliente -->
                        <div class="mb-3">
                            <x-input-label for="search-client" :value="__('sale.client_name')" />
                            <input style="border: 1px solid #dee2e6; border-radius: 5px !important;"
                                   type="text" id="search-client" class="form-control" placeholder="Buscar cliente por nombre..." required>

                            <!-- Input hidden para almacenar el id del cliente seleccionado -->
                            <input type="hidden" id="cliente_id" name="cliente_id">

                            <!-- Lista de clientes que coinciden con la búsqueda -->
                            <ul id="client-list-group" class="list-group mt-3"></ul>
                        </div>

                        <!-- Método de Pago -->
                        <div class="mb-3">
                            <x-input-label for="pago_id" :value="__('sale.payment_method')" />
                            <select id="pago_id" class="form-control" name="pago_id" required>
                                @foreach($pagos as $pago)
                                    <option value="{{ $pago->id }}">{{ $pago->metodo_pago }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('pago_id')" class="mt-2" />
                        </div>

                        <!-- Productos -->
                        <div id="product-section">
                            <h4>{{ __('sale.add_product') }}</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control" id="producto_id" name="producto_id" required>
                                        @foreach($productos as $producto)
                                            @php
                                                $inventario = $inventarios->firstWhere('product_id', $producto->id);
                                            @endphp
                                            <option value="{{ $producto->id }}"
                                                    data-price="{{ $producto->en_promocion ? $producto->precio_promocional : $producto->price }}"
                                                    data-stock="{{ $inventario ? $inventario->stock : 0 }}">
                                                {{ $producto->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button title="{{__('sale.add_product')}}" type="button" id="add-product-btn" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>

                            <!-- Tabla de productos agregados -->
                            <table class="table mt-4" id="products-table">
                                <thead>
                                <tr>
                                    <th>{{ __('sale.product_name') }}</th>
                                    <th>{{ __('sale.current_stock') }}</th>
                                    <th>{{ __('sale.stock_remaining') }}</th>
                                    <th>{{ __('sale.quantity') }}</th>
                                    <th>{{ __('sale.unit_price') }}</th>
                                    <th>{{ __('sale.subtotal') }}</th>
                                    <th>{{ __('sale.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Aquí se agregarán los productos dinámicamente -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Subtotal y Total -->
                        <div id="totals-placeholder" class="mt-4">
                            <h1 style="font-weight: 800; font-size: 35px">{{ __('sale.grand_total') }}: Q <span id="grand_total">0.00</span></h1>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <x-a-ref linkRef="{{ route('ventas.index') }}">
                                {{ __('sale.back') }}
                            </x-a-ref>
                            <x-primary-button>
                                {{ __('sale.save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let productIndex = 0; // Inicializar el índice de productos

    // Función de búsqueda dinámica y mostrar resultados en list group
    document.getElementById('search-client').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const clientListGroup = document.getElementById('client-list-group');

        // Limpiar el list group
        clientListGroup.innerHTML = '';

        // Si no se escribe nada, vaciar la lista de clientes
        if (searchValue === '') {
            clientListGroup.style.display = 'none';
            return;
        }

        clientListGroup.style.display = ''; // Mostrar el list group cuando haya coincidencias

        // Crear las opciones para los clientes que coincidan
        const clientes = @json($clientes); // Obtener todos los clientes del backend
        clientes.forEach(cliente => {
            const clienteNombre = `${cliente.first_name} ${cliente.last_name}`.toLowerCase();
            if (clienteNombre.includes(searchValue)) {
                // Crear un list group item para cada cliente que coincida
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item', 'list-group-item-action');

                listItem.innerHTML = `${cliente.first_name} ${cliente.last_name}`;

                // Agregar evento de clic para seleccionar el cliente
                listItem.addEventListener('click', function() {
                    document.getElementById('cliente_id').value = cliente.id; // Guardar el ID del cliente
                    clientListGroup.innerHTML = ''; // Limpiar la lista
                    clientListGroup.style.display = 'none'; // Ocultar el list group
                    document.getElementById('search-client').value = `${cliente.first_name} ${cliente.last_name}`; // Mostrar el nombre seleccionado en el campo de búsqueda
                });

                // Agregar el list item al list group
                clientListGroup.appendChild(listItem);
            }
        });
    });

    function showErrorAlert(message) {
        const alertDiv = document.getElementById('dynamic-error-alert');
        alertDiv.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    }

    document.getElementById('add-product-btn').addEventListener('click', function() {
        const productoSelect = document.getElementById('producto_id');
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        const currentStock = parseInt(selectedOption.getAttribute('data-stock')); // Obtener el stock disponible
        const price = parseFloat(selectedOption.getAttribute('data-price'));
        const cantidad = 1; // Cantidad por defecto cuando se agrega el producto

        if (currentStock <= 0) {
            showErrorAlert('No hay suficiente stock disponible.');
            return;
        }

        if(cantidad > currentStock) {
            showErrorAlert('No puedes agregar más cantidad de la disponible en stock.');
            return;
        }

        // Verificar si el producto ya fue agregado buscando por su ID
        const existingRow = document.querySelector(`#products-table tbody tr[data-product-id="${selectedOption.value}"]`);

        if (existingRow) {
            // Si el producto ya existe, sumar la cantidad y actualizar el subtotal
            const cantidadInput = existingRow.querySelector('.bodyCantidad');
            let currentCantidad = parseInt(cantidadInput.value); // Definir correctamente currentCantidad
            let newCantidad = currentCantidad + cantidad;

            if (newCantidad > currentStock) {
                showErrorAlert('No puedes agregar más cantidad de la disponible en stock.');
                return;
            }

            cantidadInput.value = newCantidad;

            // Actualizar el subtotal de esa fila
            const subtotalInput = existingRow.querySelector('.totalData');
            subtotalInput.value = (newCantidad * price).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

            // Actualizar el stock restante
            const stockRemainingInput = existingRow.querySelector('.stockRemaining');
            stockRemainingInput.value = currentStock - newCantidad;

        } else {
            // Si el producto no está en la tabla, agregar una nueva fila
            const tableBody = document.querySelector('#products-table tbody');
            const newRow = document.createElement('tr');
            newRow.setAttribute('data-product-id', selectedOption.value); // Asignamos un atributo para identificar la fila del producto
            newRow.innerHTML = `
        <td>${selectedOption.text}</td>
        <td><input style="border: 1px solid #dee2e6; border-radius: 5px !important;" class="currentStock form-control" type="number" value="${currentStock}" readonly></td>
        <td><input style="border: 1px solid #dee2e6; border-radius: 5px !important;" class="stockRemaining form-control" type="number" value="${currentStock - cantidad}" readonly></td>
        <td><input style="border: 1px solid #dee2e6; border-radius: 5px !important;" class="bodyCantidad form-control" type="number" name="productos[${productIndex}][cantidad]" value="${cantidad}" min="1"></td>
        <td>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Q. </span>
                <input style="border: 1px solid #dee2e6; border-radius: 5px !important;" class="subTotalData form-control" type="text" value="${price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}" readonly>
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Q. </span>
                <input style="border: 1px solid #dee2e6; border-radius: 5px !important;" class="totalData form-control" type="text" value="${(cantidad * price).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}" readonly>
            </div>
        </td>
        <td><input type="hidden" name="productos[${productIndex}][id]" value="${selectedOption.value}">
        <button title="{{__('sale.delete_product')}}" type="button" class="btn btn-danger remove-product"><i class="fas fa-trash"></i></button></td>
    `;
            tableBody.appendChild(newRow);

            // Incrementar el índice de productos
            productIndex++;

            // Eliminar producto
            newRow.querySelector('.remove-product').addEventListener('click', function() {
                newRow.remove();
                updateTotals();
            });

            // Actualizar subtotal y total cuando cambie la cantidad en cualquier fila
            newRow.querySelector('.bodyCantidad').addEventListener('input', function() {
                const cantidadNueva = parseInt(this.value);

                const totalInput = newRow.querySelector('.totalData');
                totalInput.value = (cantidadNueva * price).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

                // Actualizar el stock restante
                const stockRemainingInput = newRow.querySelector('.stockRemaining');
                stockRemainingInput.value = currentStock - cantidadNueva;
                if(cantidadNueva > currentStock) {
                    showErrorAlert('No puedes agregar más cantidad de la disponible en stock.');
                    this.value = currentStock;
                    stockRemainingInput.value = 0;
                    return
                }
                updateTotals();
            });
        }

        // Actualizar el total general
        updateTotals();
    });

    function updateTotals() {
        let subtotal = 0;
        document.querySelectorAll('#products-table tbody tr').forEach(function(row) {
            const cantidad = parseInt(row.querySelector('.bodyCantidad').value);
            const unitPrice = parseFloat(row.querySelector('.subTotalData').value.replace(/,/g, ''));
            subtotal += cantidad * unitPrice;
        });

        document.getElementById('grand_total').innerText = subtotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Llamar a la función para asegurar que la visibilidad sea correcta al cargar la página
    updateTotals();

</script>
