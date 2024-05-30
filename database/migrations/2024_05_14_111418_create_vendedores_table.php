<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 50)->unique();
            $table->string('nickname', 100);
            $table->binary('imagen')->nullable();
            $table->string('password', 100);
            $table->string('google-__id')->nullable();
            $table->date('fecha_nac');
            $table->string('telefono', 20)->nullable();
            $table->string('provincia', 20)->nullable();
            $table->string('direccion', 70)->nullable();
            $table->integer('total_ventas')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedores');
    }
};
