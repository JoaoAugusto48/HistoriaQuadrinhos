<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtensilioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('utensilios')->insert(
            array(
                [
                    'id' => 1,
                    'caminho' => 'utensilio/utensilio1.png',
                    'descricao' => 'Cadeira 1',
                    'status' => true,
                ],
                [
                    'id' => 2,
                    'caminho' => 'utensilio/utensilio2.png',
                    'descricao' => 'Cadeira 2',
                    'status' => true,
                ],
                [
                    'id' => 3,
                    'caminho' => 'utensilio/utensilio3.png',
                    'descricao' => 'Cadeira 3',
                    'status' => true,
                ],
                [
                    'id' => 4,
                    'caminho' => 'utensilio/objeto.png',
                    'descricao' => 'Vaso de Flor 1',
                    'status' => true,
                ],
                [
                    'id' => 5,
                    'caminho' => 'utensilio/objeto2.png',
                    'descricao' => 'Vaso de Flor 2',
                    'status' => true,
                ],
                [
                    'id' => 6,
                    'caminho' => 'utensilio/objeto3.png',
                    'descricao' => 'Mesa 1',
                    'status' => true,
                ],
                [
                    'id' => 7,
                    'caminho' => 'utensilio/objeto4.png',
                    'descricao' => 'Mesa 2',
                    'status' => true,
                ],
                [
                    'id' => 8,
                    'caminho' => 'utensilio/objeto5.png',
                    'descricao' => 'Relógio 1',
                    'status' => true,
                ],
                [
                    'id' => 9,
                    'caminho' => 'utensilio/objeto6.png',
                    'descricao' => 'Relógio 2',
                    'status' => true,
                ],
            )
        );
    }
}
