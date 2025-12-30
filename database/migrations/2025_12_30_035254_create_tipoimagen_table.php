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
        Schema::create('tipoimagen', function (Blueprint $table) {
            $table->id('idtipoimagen')->autoIncrement();
            $table->string('tipoimagen', 100);
            $table->dateTime('fechareg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipoimagen');
    }
};
