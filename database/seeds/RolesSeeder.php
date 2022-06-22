<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'nombre' => 'Desarrollador',
            ],
            [
                'nombre' => 'Analista',
            ],
            [
                'nombre' => 'Tester',
            ],
            [
                'nombre' => 'Diseñador',
            ],
            [
                'nombre' => 'Profesional PMO',
            ],
            [
                'nombre' => 'Profesional de servicios',
            ],
            [
                'nombre' => 'Auxiliar administrativo',
            ],
            [
                'nombre' => 'Codirector',
            ],
        ]);
    }
}
