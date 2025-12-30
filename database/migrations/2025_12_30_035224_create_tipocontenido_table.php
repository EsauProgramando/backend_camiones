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
        Schema::create('tipocontenido', function (Blueprint $table) {
         $table->id('idtipocontenido')->autoIncrement();
         $table->string('tipocontenido', 100);         
               $table->dateTime('fechareg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipocontenido');
    }
};
