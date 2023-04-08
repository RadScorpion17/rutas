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
        Schema::create('eot.itinerarios', function (Blueprint $table) {
            $table->id();
            $table->char('descripcion',100);
            $table->time('horario_salida');
            $table->time('intervalo');
            $table->char('tipo',10);
            $table->char('linea',10);
            $table->char('estado',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eot.itinerarios');
    }
};
