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
        Schema::create('eot.rutas', function (Blueprint $table) {
            $table->id();
            $table->integer('itinerario')->references('id')->on('itinerarios');
            $table->char('ruta_hex',20);
            $table->char('ruta_gtfs',20);
            $table->integer('ruta_dec');
            $table->char('sentido',10);
            $table->integer('id_origen');
            $table->integer('id_destino');
            $table->double('tamano_ruta');
            $table->char('tipo_ruta',20);
            $table->char('estado',20);
            $table->boolean('ingreso_asu');
            $table->char('file',250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eot.rutas');
    }
};
