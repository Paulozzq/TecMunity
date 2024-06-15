<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->bigIncrements('ID_publicacion'); // Primary key with auto-increment
            $table->unsignedBigInteger('ID_usuario'); // Foreign key
            $table->text('contenido'); // Content of the publication
            $table->string('url_media')->nullable(); // Media URL, can be null

            $table->foreign('ID_usuario')->references('ID_usuario')->on('usuarios')->onDelete('cascade');

            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicaciones');
    }
}
