<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrerasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carreras')->insert([
            'ID_carrera' => 1,
            'nombre' => 'Ingeniería en Informática',
            'ID_departamento' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            
        ]);

        DB::table('carreras')->insert([
            'ID_carrera' => 2,
            'nombre' => 'Diseño industrial',
            'ID_departamento' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            
        ]);
    }
}
