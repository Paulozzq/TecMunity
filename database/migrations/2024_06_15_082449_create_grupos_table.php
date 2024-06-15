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
            $table->bigIncrements('ID_grupo');
            $table->string('nombre');
            $table->string('descripcion');
            $table->unsignedBigInteger('ID_carrera')->nullable;
            $table->unsignedBigInteger('ID_creador');
            $table->timestamps();

            //FK
            $table->foreign('ID_carrera')->references('ID_carrera')->on('carreras')->onDelete('cascade');
            $table->foreign('ID_creador')->references('ID_usuario')->on('usuarios')->onDelete('cascade');

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
