<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->bigIncrements('ID_mensaje');
            $table->unsignedBigInteger('ID_emisor');
            $table->unsignedBigInteger('ID_receptor');
            $table->text('contenido');
            $table->timestamp('fecha')->useCurrent();

            // Foreign keys
            $table->foreign('ID_emisor')->references('ID_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('ID_receptor')->references('ID_usuario')->on('usuarios')->onDelete('cascade');

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
        Schema::dropIfExists('mensajes');
    }
}
