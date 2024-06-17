<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departamentos')->insert([
            'ID_departamento' => 1,
            'nombre' => 'Informatica',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('departamentos')->insert([
            'ID_departamento' => 2,
            'nombre' => 'Mineria',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('departamentos')->insert([
            'ID_departamento' => 3,
            'nombre' => 'Industrial',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
