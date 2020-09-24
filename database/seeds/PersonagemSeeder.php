<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personagems')->insert(
            array(
                [
                    'id' => 1,
                    'personagem' => 'personagem/personagem1.png',
                    'descricao' => 'personagem1'
                ],
                [
                    'id' => 2,
                    'personagem' => 'personagem/personagem2.png',
                    'descricao' => 'personagem2'
                ],
                [
                    'id' => 3,
                    'personagem' => 'personagem/personagem3.png',
                    'descricao' => 'personagem3'
                ],
                [
                    'id' => 4,
                    'personagem' => 'personagem/personagem4.png',
                    'descricao' => 'personagem4'
                ],
                [
                    'id' => 5,
                    'personagem' => 'personagem/personagem5.png',
                    'descricao' => 'personagem5'
                ]
            )
        );
    }
}
