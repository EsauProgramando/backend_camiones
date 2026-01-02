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
        Schema::create('mensajes', function (Blueprint $table) {
           $table->id('idmensaje')->autoIncrement();
            $table->text('contenido');
            $table->string('contacto', 150);
            $table->string('email', 150);
            $table->dateTime('fechareg');
            $table->tinyInteger('estareg')->default(true); // 1 = activo, 0 = inactivo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
