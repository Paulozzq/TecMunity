<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosusuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estadosusuarios')->insert([
            'ID_estadousuario' => 1,
            'nombre_estado' => 'Activo',
            'descripcion_estado' => 'Usuario activo en el sistema',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('estadosusuarios')->insert([
            'ID_estadousuario' => 2,
            'nombre_estado' => 'Inactivo',
            'descripcion_estado' => 'Usuario inactivo en el sistema',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
