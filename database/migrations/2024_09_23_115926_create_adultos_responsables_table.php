<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adultos_responsables', function (Blueprint $table) {
            $table->id();
           
            
            $table->enum('tipo', ['madre', 'padre', 'tutor']);
            $table->string('apellido');
            $table->string('nombre');
            $table->string('nacionalidad');
            $table->boolean('asistio_establecimiento_educacional');
            $table->enum('nivel_mas_alto', ['primario', 'secundario', 'terciario', 'universitario']);
            $table->boolean('completo_nivel');
            $table->boolean('vive');
            $table->string('tipo_documento')->nullable();
            $table->string('numero_documento');
            $table->enum('posesion', ['en tramite', 'no tiene documento'])->nullable();
            $table->string('domicilio_calle')->nullable();
            $table->string('domicilio_numero')->nullable();
            $table->string('domicilio_piso')->nullable();
            $table->string('domicilio_torre')->nullable();
            $table->string('domicilio_dpto')->nullable();
            $table->foreignId('pais_id')->constrained('pais')->nullable();
            $table->foreignId('provincia_id')->constrained('provincias')->nullable();
            $table->foreignId('partido_id')->constrained('partidos')->nullable();
            $table->foreignId('ciudad_id')->constrained('ciudads')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->boolean('jefe_hogar')->nullable();
            $table->string('profesion')->nullable();
            $table->enum('condicion_actividad', ['solo_trabaja', 'trabaja_y_estudia', 'busca_trabajo_y_estudia', 'solo_busca_trabajo', 'trabaja_y_recibe_jubilacion', 'busca_trabajo_y_recibe_jubilacion', 'jubilado_pensionado', 'solo_estudia', 'otro'])->nullable();

            $table->foreignId('inscripcion_id')->constrained('inscripcion')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adultos_responsables');
    }
};
