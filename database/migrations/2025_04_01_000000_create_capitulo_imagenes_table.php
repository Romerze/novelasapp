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
        Schema::create('capitulo_imagenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('capitulo_id')->constrained()->onDelete('cascade');
            $table->string('ruta');
            $table->string('nombre_original');
            $table->string('tipo_mime');
            $table->integer('posicion')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capitulo_imagenes');
    }
};
