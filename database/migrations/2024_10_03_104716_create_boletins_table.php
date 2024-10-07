<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boletins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curso_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ciclo_lectivo');

            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ciclo_lectivo')->references('id')->on('configuracion')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['curso_id', 'user_id', 'ciclo_lectivo'], 'unique_boletin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boletins');
    }
};
