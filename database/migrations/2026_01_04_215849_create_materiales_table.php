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
        Schema::create('materiales', function (Blueprint $table) {
            $table->id('idmateriales')->autoIncrement();
            $table->string('titulo', 150);
            $table->string('descripcion1', 350);
            $table->string('descripcion2', 350);
            $table->string('nombrematerial', 150);
            $table->string('nombrefoto',80);
            $table->tinyInteger('estareg')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales');
    }
};
