<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id('ID_comentario');
            $table->unsignedBigInteger('ID_publicacion');
            $table->unsignedBigInteger('ID_usuario');
            $table->integer('nro_likes')->default(0);
            $table->text('contenido');
            $table->string('url_media')->nullable(); // Media URL, can be null
            $table->timestamp('fecha')->useCurrent();
            $table->unsignedBigInteger('reply')->nullable();
            $table->foreign('ID_publicacion')->references('ID_publicacion')->on('publicaciones')->onDelete('cascade');
            $table->foreign('ID_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('reply')->references('Id_comentario')->on('comentarios')->onDelate('cascade');
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
        Schema::dropIfExists('comentarios');
    }
}
