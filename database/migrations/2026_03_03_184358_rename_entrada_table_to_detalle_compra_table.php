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
        Schema::rename('entradas', 'detalle_compra');
        Schema::rename('salidas', 'detalle_despacho');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('detalle_compra', 'entradas');
        Schema::rename('detalle_despacho', 'salidas');
    }
};
