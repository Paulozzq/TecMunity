<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id('ID_notificacion');
            $table->unsignedBigInteger('user1');
            $table->unsignedBigInteger('user2')->nullable();
            $table->unsignedBigInteger('ID_tipo')->default(0);
            $table->boolean('leido')->default(false);
            $table->timestamp('fecha')->useCurrent();

            // Foreign keys
            $table->foreign('user1')->references('ID_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('user2')->references('ID_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('ID_tipo')->references('ID_tiponotificacion')->on('tiponotificaciones')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificaciones');
    }
}
