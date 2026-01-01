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
        Schema::table('contenido', function (Blueprint $table) {
             $table->string('titulo')->after('idcontenido');
            $table->string('color')->after('titulo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contenido', function (Blueprint $table) {
           $table->dropColumn(['titulo', 'color']);
        });
    }
};
