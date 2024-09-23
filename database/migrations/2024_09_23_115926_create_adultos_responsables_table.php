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
            $table->string('name', 45);
            $table->string('dni', 45)->unique();
            $table->string('relacion', 45)->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adultos_responsables');
    }
};
