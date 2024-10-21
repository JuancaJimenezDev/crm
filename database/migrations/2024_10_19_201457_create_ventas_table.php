<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Usuario que realiza la venta
            $table->unsignedBigInteger('cliente_id'); // Cliente que compra
            $table->unsignedBigInteger('pago_id'); // Método de pago
            $table->date('fecha_venta');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('gran_total', 8, 2);
            $table->timestamps();

            // Relaciones con usuarios, clientes y métodos de pago
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
            $table->foreign('pago_id')->references('id')->on('pagos')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
