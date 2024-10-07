<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscripcion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('curso_id')->nullable()->constrained('cursos')->onDelete('cascade');

            // Datos académicos
            $table->enum('nivel_cursado', ['ciclo basico', 'CESAJ', 'ciclo superior'])->default('ciclo basico')->nullable();
            $table->string('grado')->nullable();
            $table->enum('turno', ['mañana', 'tarde', 'noche', 'vespertino', 'intermedio'])->default('mañana')->nullable();
            $table->enum('jornada', ['simple', 'completa', 'extendida', 'doble escolaridad'])->default('doble escolaridad')->nullable();
            $table->enum('condicion_alumno', ['ingresante', 'reinscripto', 'promovido', 'repitente'])->nullable();
            $table->string('establecimiento_procedencia')->nullable();
            
            // Datos personales
            $table->string('tipo_documento', 20)->nullable();
            $table->string('dni', 45)->nullable();
            $table->boolean('estado_documento')->nullable();
            $table->enum('posesion', ['posee', 'en tramite', 'no posee'])->nullable();
            $table->foreignId('genero_id')->nullable()->constrained('generos');
            $table->string('nacionalidad')->nullable();
            $table->string('lugar_nac')->nullable();
            $table->date('fecha_nac')->nullable();
            
            // Domicilio y contacto
            $table->string('calle')->nullable();
            $table->integer('numero')->nullable();
            $table->string('piso')->nullable();
            $table->string('torre')->nullable();
            $table->string('dpto')->nullable();
            $table->string('entre_calles')->nullable();
            $table->foreignId('pais_id')->nullable()->constrained('pais');
            $table->foreignId('provincia_id')->nullable()->constrained('provincias');
            $table->foreignId('partido_id')->nullable()->constrained('partidos');
            $table->foreignId('ciudad_id')->nullable()->constrained('ciudads');
            $table->string('telefono', 45)->nullable();
            $table->string('telefono_celular', 45)->nullable();

            // Información adicional
            $table->integer('cantidad_hermanos')->nullable();
            $table->integer('cantidad_habitantes_hogar')->nullable();
            $table->enum('medio_transporte', ['a pie', 'omnibus', 'auto particular', 'taxi/remis', 'otro'])->default('omnibus')->nullable();
            $table->string('medio_transporte_otro')->nullable();

            // Salud y obra social
            $table->string('obra_social')->nullable();
            $table->string('numero_afiliado')->nullable();
            $table->boolean('enfermedad')->nullable();
            $table->string('descripcion_enfermedad')->nullable();
            $table->boolean('alergia')->nullable();
            $table->string('descripcion_alergia')->nullable();
            $table->boolean('tratamiento_permanente')->nullable();
            $table->string('descripcion_tratamiento')->nullable();
            $table->boolean('limitacion_fisica')->nullable();
            $table->string('descripcion_limitacion')->nullable();
            $table->string('otros_problemas_salud')->nullable();

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('inscripcion');
    }
};
