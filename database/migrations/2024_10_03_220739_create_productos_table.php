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
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // Campo 'id' auto incremental
            $table->string('nombre'); // Campo 'nombre'
            $table->integer('stock'); // Campo 'stock'
            $table->date('fecha_vencimiento')->nullable(); // Campo 'fecha de vencimiento'
            $table->foreignId('id_categoria')->constrained('categorias')->onDelete('cascade'); // Relación con la tabla 'categorias'
            $table->timestamps(); // Campos de timestamps (created_at y updated_at)
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
