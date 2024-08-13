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
        Schema::create('experiencia_formativa', function (Blueprint $table) {
            $table->id();  // id SERIAL PRIMARY KEY
            $table->unsignedBigInteger('especialidad_id');  // CHAR(4) NOT NULL
            $table->string('componente', 255)->default('Experiencias Formativas en Situación Real de Trabajo');  // VARCHAR(255) NOT NULL DEFAULT ...
            $table->date('fecha_inicio');  // DATE NOT NULL
            $table->date('fecha_termino');  // DATE NOT NULL
            $table->integer('creditos');  // INT NOT NULL
            $table->integer('dias');  // INT NOT NULL
            $table->integer('horas');  // INT NOT NULL

            $table->foreign('especialidad_id')->references('id')->on('especialidad')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();  // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiencia_formativa');
    }
};
