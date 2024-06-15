<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmistadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amistades', function (Blueprint $table) {
            $table->bigIncrements('ID_amistad');
            $table->unsignedBigInteger('ID_usuario');
            $table->unsignedBigInteger('ID_amigo');
            $table->timestamp('fecha')->useCurrent();
            $table->unsignedBigInteger('ID_estadoamistad')->default(0);

            // Foreign keys
            $table->foreign('ID_usuario')->references('ID_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('ID_amigo')->references('ID_usuario')->on('usuarios')->onDelete('cascade');

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
        Schema::dropIfExists('amistades');
    }
}
