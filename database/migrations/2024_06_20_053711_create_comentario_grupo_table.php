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
        Schema::create('comentario_grupo', function (Blueprint $table) {
            $table->id('ID_comentario_grupo');
            $table->unsignedBigInteger('ID_grupo');
            $table->unsignedBigInteger('ID_usuario');
            $table->unsignedBigInteger('ID_publicacion'); // Nueva columna para la relación con la publicación del grupo
            $table->integer('nro_likes')->default(0);
            $table->text('contenido')->nullable();
            $table->string('url_media')->nullable();
            $table->timestamp('fecha')->useCurrent();
            $table->unsignedBigInteger('reply')->nullable();
            $table->foreign('ID_grupo')->references('ID_grupos')->on('grupos')->onDelete('cascade');
            $table->foreign('ID_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('ID_publicacion')->references('ID_publicacion')->on('publicacion_grupo')->onDelete('cascade'); // Referencia a la tabla de publicaciones_grupos
            $table->foreign('reply')->references('ID_comentario_grupo')->on('comentario_grupo')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentario_grupo');
    }
};
