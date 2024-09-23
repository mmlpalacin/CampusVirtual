<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('date');
            $table->enum('estado', ['presente', 'tarde', 'ausente']);
            $table->enum('turno', ['taller', 'aula'])->nullable();
            $table->unique(['user_id', 'date', 'turno']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('asistencia');
    }
};
