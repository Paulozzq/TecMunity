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
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id('ID_denuncias');
            $table->unsignedBigInteger('denunciado');
            $table->unsignedBigInteger('denunciante');
            $table->unsignedBigInteger('publicacion');
            $table->text('contenido');
            $table->string('tipo');
            $table->string('status')->nullable();
            $table->timestamp('fecha_de_aprobacion')->nullable();
            $table->timestamps();

            // claves foraneas
            $table->foreign('denunciado')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('denunciante')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('publicacion')->references('ID_publicacion')->on('publicaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
};
