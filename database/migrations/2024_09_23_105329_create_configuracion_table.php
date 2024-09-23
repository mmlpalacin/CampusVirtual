<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('direccion', 45)->nullable();
            $table->string('telefono', 45)->nullable();
            $table->year('ciclo_lectivo');
            $table->json('grados')->nullable();
            $table->json('cooperadora');
            $table->json('jornadas');
            $table->json('dias');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->enum('tipo_evaluacion', ['numerica', 'letras'])->default('numerica');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('configuracion');
    }
};
