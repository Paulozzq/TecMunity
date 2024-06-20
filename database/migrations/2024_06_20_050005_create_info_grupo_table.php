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
        Schema::create('info_grupo', function (Blueprint $table) {
            $table->id('ID_info');
            $table->unsignedBigInteger('ID_grupo');
            $table->text('descripcion');
            $table->string('avatar')->nullable();
            $table->string('portada')->nullable();
            $table->string('tema');
            $table->boolean('privado');
            $table->timestamps();

            $table->foreign('ID_grupo')->references('ID_grupos')->on('grupos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_grupo');
    }
};
