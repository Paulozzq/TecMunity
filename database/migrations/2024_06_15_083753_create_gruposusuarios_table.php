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
        Schema::create('gruposusuarios', function (Blueprint $table) {
          // Claves primarias y foráneas compuestas
          $table->unsignedBigInteger('ID_usuario');
          $table->unsignedBigInteger('ID_grupo');

          // Clave primaria compuesta
          $table->primary(['ID_usuario', 'ID_grupo']);

          // Claves foráneas
          $table->foreign('ID_usuario')->references('ID_usuario')->on('usuarios')->onDelete('cascade');
          $table->foreign('ID_grupo')->references('ID_grupo')->on('grupos')->onDelete('cascade');

          // Columna de fecha
          $table->timestamp('fecha')->useCurrent();

          // Timestamps opcionales si deseas mantener created_at y updated_at
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gruposusuarios');
    }
};
