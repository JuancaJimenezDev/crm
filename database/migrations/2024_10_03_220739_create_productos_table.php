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
            $table->id();
            $table->string('nombre');
            $table->decimal('precio', 10, 2);
            $table->boolean('en_promocion')->default(false);
            $table->decimal('precio_promocional', 10, 2)->nullable();
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
