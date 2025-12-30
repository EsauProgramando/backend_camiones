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
        Schema::create('contenido', function (Blueprint $table) {
         $table->id('idcontenido')->autoIncrement();
         $table->text('parrafo');
         $table->integer('correlativo');
         $table->unsignedBigInteger('idtipocontenido');
         $table->char('estareg', 1);
         $table->dateTime('fechareg');
        $table->foreign('idtipocontenido')
          ->references('idtipocontenido')
          ->on('tipocontenido');
  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenido');
    }
};
