<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BalaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('balaos')->insert(
            array(
                [
                    'id' => 1,
                    'caminho' => 'balao/balaoDireita1.png',
                    'descricao' => 'balao1',
                    'status' => true,
                ],
                [
                    'id' => 2,
                    'caminho' => 'balao/balaoDireita2.png',
                    'descricao' => 'balao2',
                    'status' => true,
                ],
                [
                    'id' => 3,
                    'caminho' => 'balao/balaoEsquerda1.png',
                    'descricao' => 'balao3',
                    'status' => true,
                ],
                [
                    'id' => 4,
                    'caminho' => 'balao/balaoEsquerda2.png',
                    'descricao' => 'balao4',
                    'status' => true,
                ]
            )
        );
    }
}
