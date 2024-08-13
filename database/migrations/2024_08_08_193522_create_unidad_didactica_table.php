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
        Schema::create('unidad_didactica', function (Blueprint $table) {
            $table->id();
            $table->char('id_indicador', 8)->unique();
            $table->char('especialidad_id', 4)->nullable();
            $table->string('nombre_unidad', 130)->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_final')->nullable();
            $table->integer('credito_unidad')->nullable();
            $table->integer('hora')->nullable();
            $table->integer('dia')->nullable();
            $table->string('descripcion_capacidad', 500)->nullable();
            $table->timestamps();
            // Foreign key constraint
            $table->foreign('especialidad_id')->references('id_unidad')->on('especialidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidad_didactica');
    }
};
