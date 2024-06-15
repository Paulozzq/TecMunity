<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('ID_like');
            $table->unsignedBigInteger('ID_usuario');
            $table->unsignedBigInteger('ID_publicacion')->nullable();; // Foreign key
            $table->unsignedBigInteger('ID_comentario')->nullable(); // Foreign key

            $table->foreign('ID_comentario')->references('ID_comentario')->on('comentarios')->onDelete('cascade');
            $table->foreign('ID_usuario')->references('ID_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('ID_publicacion')->references('ID_publicacion')->on('publicaciones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
