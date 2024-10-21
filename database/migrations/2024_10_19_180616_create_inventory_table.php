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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Relacionado con el ID del producto
            $table->integer('stock');
            $table->unsignedBigInteger('added_by'); // Usuario que agregó el producto
            $table->unsignedBigInteger('updated_by')->nullable(); // Usuario que actualizó el producto
            $table->timestamps();

            // Relaciones con productos y usuarios
            $table->foreign('product_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory');
    }
};
