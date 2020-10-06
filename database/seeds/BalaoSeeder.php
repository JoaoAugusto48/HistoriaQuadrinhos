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
                    'descricao' => 'Balão - fala',
                    'status' => true,
                ],
                [
                    'id' => 2,
                    'caminho' => 'balao/balaoDireita2.png',
                    'descricao' => 'Balão - fala 2',
                    'status' => true,
                ],
                [
                    'id' => 3,
                    'caminho' => 'balao/balaoEsquerda1.png',
                    'descricao' => 'Balão - fala 3',
                    'status' => true,
                ],
                [
                    'id' => 4,
                    'caminho' => 'balao/balaoEsquerda2.png',
                    'descricao' => 'Balão - fala 4',
                    'status' => true,
                ],
                [
                    'id' => 5,
                    'caminho' => 'balao/balaoFala.png',
                    'descricao' => 'Balão - fala 5',
                    'status' => true,
                ],
                [
                    'id' => 6,
                    'caminho' => 'balao/balaoFala2.png',
                    'descricao' => 'Balão - fala 6',
                    'status' => true,
                ],
                [
                    'id' => 7,
                    'caminho' => 'balao/balaoFala3.png',
                    'descricao' => 'Balão - fala 7',
                    'status' => true,
                ],
                [
                    'id' => 8,
                    'caminho' => 'balao/balaoFala4.png',
                    'descricao' => 'Balão - fala 8',
                    'status' => true,
                ],
                [
                    'id' => 9,
                    'caminho' => 'balao/balaoPensamento.png',
                    'descricao' => 'Balão - pensamento',
                    'status' => true,
                ],
            )
        );
    }
}
