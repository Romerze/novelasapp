<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('novelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('sinopsis')->nullable();
            $table->text('imagen_portada')->nullable();
            $table->enum('estado', ['borrador', 'en_progreso', 'completada', 'en_pausa'])->default('borrador');
            $table->boolean('publicada')->default(false);
            $table->integer('visitas')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novelas');
    }
};
