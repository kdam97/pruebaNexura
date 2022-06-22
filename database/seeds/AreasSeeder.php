<?php

use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            [
                'nombre' => 'Administrativa y Financiera',
            ],
            [
                'nombre' => 'Ingeniería',
            ],
            [
                'nombre' => 'Desarrollo de Negocio',
            ],
            [
                'nombre' => 'Proyectos',
            ],
            [
                'nombre' => 'Servicios',
            ],
            [
                'nombre' => 'Calidad',
            ],
        ]);
    }
}
