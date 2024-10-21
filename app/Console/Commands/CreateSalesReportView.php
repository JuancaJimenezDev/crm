<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateSalesReportView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sales-report:create-view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the sales report view in the database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        DB::statement("
            CREATE VIEW sales_report_view AS
            SELECT
                ventas.id AS venta_id,
                cliente.first_name AS cliente_nombre,
                cliente.last_name AS cliente_apellido,
                users.name AS vendedor_nombre,
                ventas.fecha_venta,
                productos.nombre AS producto_nombre,
                detalle_ventas.cantidad,
                detalle_ventas.precio_unitario,
                detalle_ventas.subtotal,
                ventas.gran_total
            FROM ventas
            INNER JOIN cliente ON ventas.cliente_id = cliente.id
            INNER JOIN users ON ventas.user_id = users.id
            INNER JOIN detalle_ventas ON ventas.id = detalle_ventas.venta_id
            INNER JOIN productos ON detalle_ventas.producto_id = productos.id
        ");

        $this->info('Sales report view created successfully!');
    }
}
