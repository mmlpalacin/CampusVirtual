<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade');
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('dia', 45)->nullable();
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->unique(['curso_id', 'materia_id', 'dia', 'hora_inicio', 'hora_fin']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
