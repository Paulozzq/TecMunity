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
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('sexo')->nullable();
            $table->unsignedBigInteger('ID_estadousuario')->default(1);// llave foranea de estadosusuarios
            $table->boolean('privado')->default(0);
            $table->unsignedBigInteger('ID_roles')->default(1);// llave foranea de roles
            $table->string('avatar')->nullable();
            $table->string('portada')->nullable();
            $table->unsignedBigInteger('ID_carrera')->nullable();//llave foranea de carreras
            $table->text('biografia')->nullable();
            $table->timestamps();
            $tabla->string('remenber_token')->nullable();
            $table->foreign('ID_carrera')->references('ID_carrera')->on('carreras')->onDelete('cascade');
            $table->foreign('ID_estadousuario')->references('ID_estadousuario')->on('Estadosusuarios')->onDelete('cascade');
            $table->foreign('ID_roles')->references('ID_roles')->on('roles')->onDelete('cascade');

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
