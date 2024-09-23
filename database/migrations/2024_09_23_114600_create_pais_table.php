<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pais', function (Blueprint $table) {
            $table->id();
            $table->string('pais', 45);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pais');
    }
};
