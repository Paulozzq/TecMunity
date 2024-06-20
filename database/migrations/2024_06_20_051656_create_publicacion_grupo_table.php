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
        Schema::create('publicacion_grupo', function (Blueprint $table) {
            $table->id('ID_publicacion');
            $table->unsignedBigInteger('ID_grupo');
            $table->unsignedBigInteger('ID_usuario');
            $table->text('contenido')->nullable(); // Permitir que el contenido sea nulo
            $table->string('url_media')->nullable();
            $table->integer('nro_likes')->default(0);
            $table->timestamps();

            $table->foreign('ID_grupo')->references('ID_grupos')->on('grupos')->onDelete('cascade');
            $table->foreign('ID_usuario')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicacion_grupo');
    }
};
