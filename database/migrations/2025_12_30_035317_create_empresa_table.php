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
        Schema::create('empresa', function (Blueprint $table) {
            $table->id('codemp')->autoIncrement();
            $table->string('nombre', 150);
            $table->string('direccion', 200);
            $table->string('celular', 20);
            $table->string('representante', 150);
            $table->decimal('latitud', 10, 7);
            $table->decimal('longitud', 10, 7);
            $table->text('descripcion');
            $table->string('horario', 100);
            $table->string('email', 150);
            $table->tinyInteger('estareg')->default(true); // 1 = activo, 0 = inactivo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa');
    }
};
