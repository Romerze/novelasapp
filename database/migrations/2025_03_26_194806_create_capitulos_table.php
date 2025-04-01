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
        Schema::create('capitulos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('novela_id')->constrained('novelas')->onDelete('cascade');
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('contenido');
            $table->integer('numero_capitulo');
            $table->boolean('publicado')->default(false);
            $table->integer('visitas')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capitulos');
    }
};
