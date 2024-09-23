<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mesa_examen', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('year', 45)->nullable();
            $table->foreignId('materia_id')->nullable()->constrained('materias')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->unique(['fecha', 'hora', 'year', 'materia_id', 'user_id']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('mesa_examen');
    }
};
