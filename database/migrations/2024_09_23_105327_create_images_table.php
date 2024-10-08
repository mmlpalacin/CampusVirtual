<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('url', 200);
            $table->string('imageable_type')->nullable();
            $table->unsignedBigInteger('imageable_id')->nullable();
            $table->foreign('imageable_id')->references('id')->on('anuncios')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
