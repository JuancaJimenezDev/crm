<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>


        .table {
            width: 100% !important;
            margin-bottom: 1rem !important;
            border: none !important;
            border-collapse: collapse !important;
        }

        .titleReport {
            background-color: #006400 !important;
            color: #ffffff !important;
            font-size: 25px !important;
        }

        .headerVentas {
            background-color: #28a745 !important;
            color: #ffffff !important;
        }

        .headerDetalles {
            background-color: #90EE90 !important;
            color: #ffffff !important;
        }
        .borderReport {
            border: 1px solid #000000 !important;
        }

        .table-bordered {
            border: 1px solid #000 !important;
        }

        .text-dark {
          font-weight: bold !important;
            color: #000000 !important;
        }

        .spaceBlanc {
            width: 100% !important;
        }

        .bg-light {
            background-color:  #fff !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-white {
            color: #fff !important;
        }

    </style>
</head>
<body>
    <table class="table" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td class="spaceBlanc bg-light" colspan="5"><div style="height: 20px; width: 100%"></div></td>
        </tr>
        <tr class="titleReport borderReport">
            <th class="borderReport" colspan="5">Reporte de ventas</th>
        </tr>
        <tr>
            <td class="spaceBlanc bg-light" colspan="5"><div style="height: 20px; width: 100%"></div></td>
        </tr>

@foreach ($reports as $report)


            <tr class="headerVentas text-white border">
                <th class="borderReport"><strong>ID Venta</strong></th>
                <th class="borderReport"><strong>Cliente</strong></th>
                <th class="borderReport"><strong>Vendedor</strong></th>
                <th class="borderReport"><strong>Fecha de Venta</strong></th>
                <th class="borderReport"><strong>Gran Total</strong></th>
            </tr>
            <tr class="borderReport">
                <td class="borderReport text-center">{{ $report->id }}</td>
                <td class="borderReport text-center">{{ $report->cliente->first_name }} {{ $report->cliente->last_name }}</td>
                <td class="borderReport text-center">{{ $report->user->name }}</td>
                <td class="borderReport text-center">{{ $report->fecha_venta }}</td>
                <td class="borderReport text-center">Q. {{ number_format($report->gran_total, 2, '.', ',') }}</td>
            </tr>
            <tr class="headerDetalles text-dark borderReport">
                <th class="borderReport"><strong>Producto</strong></th>
                <th class="borderReport"><strong>Cantidad</strong></th>
                <th class="borderReport"><strong>Precio Unitario</strong></th>
                <th class="borderReport" style="text-align: center;" colspan="2"><strong>Subtotal</strong></th>
            </tr>
                @foreach ($report->detalles as $detalle)
                    <tr class="borderReport text-center">
                        <td class="borderReport text-center">{{ $detalle->producto->nombre }}</td>
                        <td class="borderReport text-center">{{ $detalle->cantidad }}</td>
                        <td class="borderReport text-center">Q. {{ number_format($detalle->precio_unitario, 2, '.', ',') }}</td>
                        <td colspan="2" class="borderReport text-center">Q. {{ number_format($detalle->subtotal, 2, '.', ',') }}</td>
                    </tr>
                @endforeach
            <tr>
                <td class="spaceBlanc bg-light" colspan="5"><div style="height: 20px; width: 100%"></div></td>
            </tr>
@endforeach

        </tbody>
    </table>
</body>
</html>
