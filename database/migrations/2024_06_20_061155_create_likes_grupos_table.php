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
        Schema::create('likes_grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_usuario');
            $table->unsignedBigInteger('ID_comentario_grupo')->nullable();
            $table->unsignedBigInteger('ID_publicacion_grupo')->nullable();
            $table->timestamps();

            // Definir restricciones de clave foránea
            $table->foreign('ID_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('ID_comentario_grupo')->references('ID_comentario_grupo')->on('comentario_grupo')->onDelete('cascade');
            $table->foreign('ID_publicacion_grupo')->references('ID_publicacion')->on('publicacion_grupo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes_grupos');
    }
};
