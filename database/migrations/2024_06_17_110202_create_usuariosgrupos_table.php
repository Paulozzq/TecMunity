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
        Schema::create('usuariosgrupos', function (Blueprint $table) {
            $table->foreignId('ID_usuario')->constrained('usuarios'); // Foreign Key hacia la tabla 'usuarios'
            $table->unsignedBigInteger('ID_grupo'); // Definir el tipo correcto de la columna ID_grupo

            // Establecer la restricción de llave foránea hacia la tabla 'grupos'
            $table->foreign('ID_grupo')->references('ID_grupos')->on('grupos');

            $table->date('fecha'); // Columna de fecha

            // Definir la clave primaria compuesta
            $table->primary(['ID_usuario', 'ID_grupo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuariosgrupos');
    }
};
