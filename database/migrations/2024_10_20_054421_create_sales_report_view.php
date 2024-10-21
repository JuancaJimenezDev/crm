<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSalesReportView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW sales_report_view AS
            SELECT
                ventas.id AS venta_id,
                clientes.first_name AS cliente_nombre,
                clientes.last_name AS cliente_apellido,
                users.name AS vendedor_nombre,
                ventas.fecha_venta,
                productos.nombre AS producto_nombre,
                detalle_ventas.cantidad,
                detalle_ventas.precio_unitario,
                detalle_ventas.subtotal,
                ventas.gran_total
            FROM ventas
            INNER JOIN clientes ON ventas.cliente_id = clientes.id
            INNER JOIN users ON ventas.user_id = users.id
            INNER JOIN detalle_ventas ON ventas.id = detalle_ventas.venta_id
            INNER JOIN productos ON detalle_ventas.producto_id = productos.id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS sales_report_view');
    }
}
