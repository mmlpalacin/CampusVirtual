<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->foreignId('turno_id')->constrained('turnos')->onDelete('cascade');
            $table->foreignId('division_id')->constrained('division')->onDelete('cascade');
            $table->foreignId('especialidad_id')->constrained('especialidad')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
