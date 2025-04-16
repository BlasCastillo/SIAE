<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoAulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_aulas')->insert([
            [
                'nombre' => 'Aula Teórica',
                'descripcion' => 'Aula para clases teóricas',
                'valor' => 20,
                'estatus' => 1,
            ],
            [
                'nombre' => 'Laboratorio de Informática',
                'descripcion' => 'Aula equipada con computadoras',
                'valor' => 20,
                'estatus' => 1,
            ],
            [
                'nombre' => 'Aula Multimedia',
                'descripcion' => 'Aula con equipos multimedia',
                'valor' => 20,
                'estatus' => 1,
            ],
        ]);
    }
}
