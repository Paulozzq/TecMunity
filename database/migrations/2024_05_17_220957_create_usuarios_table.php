<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('ID_usuario');
            $table->string('nombre', 100)->nullable();
            $table->string('apellido', 200)->nullable();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('sexo')->nullable();
            $table->unsignedBigInteger('ID_estadousuario')->default(0);
            $table->boolean('privado')->default(0);
            $table->unsignedBigInteger('ID_roles')->default(0);
            $table->string('avatar')->nullable();
            $table->string('portada')->nullable();
            $table->unsignedBigInteger('ID_carrera')->nullable();
            $table->text('biografia')->nullable();

            //aca estan las FK
            $table->foreign('ID_roles')->references('ID_roles')->on('roles')->onDelete('cascade');
            $table->foreign('ID_carrera')->references('ID_carrera')->on('carreras')->onDelete('cascade');
            $table->foreign('ID_estadousuario')->references('ID_estadousuario')->on('estadosusuarios')->onDelete('cascade');
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
        Schema::dropIfExists('usuarios');
    }
}
