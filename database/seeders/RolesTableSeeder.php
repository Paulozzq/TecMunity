<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'ID_roles' => 1,
            'nombre_roles' => 'usuario normal',
            'descripcion_roles' => 'usuario con permisos limitados',
            'created_at' => now(),
            'updated_at' => now(),
            
        ]);

        DB::table('roles')->insert([
            'ID_roles' => 2,
            'nombre_roles' => 'administrador',
            'descripcion_roles' => 'usuario con permisos ilimitados',
            'created_at' => now(),
            'updated_at' => now(),
            
        ]);
    }
}
