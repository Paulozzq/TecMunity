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
            $table->id('ID_usuariogrupo');
            $table->unsignedBigInteger('ID_usuario');
            $table->unsignedBigInteger('ID_grupos');

            $table->foreign("ID_usuario")->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign("ID_grupos")->references('ID_grupos')->on('grupos')->onDelete('cascade');

            $table->date('fecha_union');
            
            $table->timestamps(); // Add timestamps if needed
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
