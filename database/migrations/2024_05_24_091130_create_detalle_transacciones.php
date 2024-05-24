<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detalle_transacciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comprador_id');
            $table->unsignedBigInteger('producto_id');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 11, 2);
            $table->decimal('subtotal', 11, 2);
            $table->dateTime('fecha');
            $table->timestamps();

            $table->foreign('comprador_id')
                ->references('id')->on('compradores')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('producto_id')
                ->references('id')->on('productos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_transacciones');
    }
};
