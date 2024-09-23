<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cooperadora', function (Blueprint $table) {
            $table->id();
            $table->foreignId('configuracion_id')->constrained('configuracion')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('pagado')->default(0);
            $table->integer('monto_pendiente')->nullable();
            $table->enum('estado', ['aprobado', 'desaprobado', 'pendiente'])->default('aprobado');
            $table->string('observacion', 45)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('cooperadora');
    }
};
