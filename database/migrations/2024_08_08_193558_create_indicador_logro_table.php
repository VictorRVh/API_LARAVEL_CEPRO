<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('indicador_logro', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 300)->nullable();
            $table->char('unidad_didactica_id', 8)->nullable();
            $table->timestamps();
            $table->foreign('unidad_didactica_id')->references('id_indicador')->on('unidad_didactica');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicador_logro');
    }
};
