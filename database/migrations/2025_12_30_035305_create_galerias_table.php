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
        Schema::create('galerias', function (Blueprint $table) {
            $table->id('idgaleria')->autoIncrement();
            $table->string('nombrefoto');
            $table->dateTime('fechareg');
            $table->dateTime('fechaupdate')->nullable();
            $table->decimal('peso', 10, 2);
            $table->unsignedBigInteger('idtipoimagen');
            $table->string('titulo');
            $table->text('parrafo');
            $table->tinyInteger('estareg')->default(true); // 1 = activo, 0 = inactivo
            $table->foreign('idtipoimagen')
                ->references('idtipoimagen')
                ->on('tipoimagen');
                
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galerias');
    }
};
