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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id('ID_grupos');
            $table->string('nombre');
            $table->date('Fecha_creacion');
            $table->unsignedBigInteger('ID_creador');
            $table->unsignedBigInteger('ID_carrera');
            $table->timestamps();

            $table->foreign('ID_creador')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('ID_carrera')->references('ID_carrera')->on('carreras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
