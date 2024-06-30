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
            $table->unsignedBigInteger('publicacion')->nullable(); // Permitir valores nulos
            $table->text('contenido');
            $table->unsignedBigInteger('ID_tipodenuncia')->default(1);
            $table->unsignedBigInteger('ID_estadodenuncia')->default(1);
            $table->timestamp('fecha_de_aprobacion')->nullable();
            $table->timestamps();
        
            // claves foraneas
            $table->foreign('denunciado')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('denunciante')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('publicacion')->references('ID_publicacion')->on('publicaciones')->onDelete('cascade');
            $table->foreign('ID_estadodenuncia')->references('ID_estadodenuncia')->on('estadosdenuncias')->onDelete('cascade');
            $table->foreign('ID_tipodenuncia')->references('ID_tipodenuncia')->on('tiposdenuncias')->onDelete('cascade');
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
