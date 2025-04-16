<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AulasSeeder extends Seeder
{
    public function run()
    {
        $aulas = [
            [
                'nombre' => 'Aula E-06',
                'capacidad' => 30,
                'tipo_aula' => 'Teoría',
                'estatus' => 1
            ],
            [
                'nombre' => 'Laboratorio Simon Bolivar',
                'capacidad' => 20,
                'tipo_aula' => 'Laboratorio',
                'estatus' => 1
            ],
            [
                'nombre' => 'Cancha techada',
                'capacidad' => 25,
                'tipo_aula' => 'Uso Multiples',
                'estatus' => 0
            ]
        ];

        DB::table('aulas')->insert($aulas);
    }
}
