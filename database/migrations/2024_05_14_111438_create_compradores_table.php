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
        Schema::create('compradores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido', 100)->nullable();
            $table->string('email', 50)->unique();
            $table->string('nickname', 100)->nullable();
            $table->binary('imagen')->nullable();
            $table->string('password', 100)->nullable();
            $table->string('google_id')->nullable();
            $table->date('fecha_nac')->nullable();
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
        Schema::dropIfExists('compradores');
    }
};
