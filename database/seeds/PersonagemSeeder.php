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
                    'descricao' => 'Personagem 1',
                    'status' => true,
                ],
                [
                    'id' => 2,
                    'personagem' => 'personagem/personagem2.png',
                    'descricao' => 'Personagem 2',
                    'status' => true,
                ],
                [
                    'id' => 3,
                    'personagem' => 'personagem/personagem3.png',
                    'descricao' => 'Personagem 3',
                    'status' => true,
                ],
                [
                    'id' => 4,
                    'personagem' => 'personagem/personagem4.png',
                    'descricao' => 'Personagem 4',
                    'status' => true,
                ],
                [
                    'id' => 5,
                    'personagem' => 'personagem/personagem5.png',
                    'descricao' => 'Personagem 5',
                    'status' => true,
                ],
                [
                    'id' => 6,
                    'personagem' => 'personagem/personagem.png',
                    'descricao' => 'Personagem 6',
                    'status' => true,
                ],
                [
                    'id' => 7,
                    'personagem' => 'personagem/personagem10.png',
                    'descricao' => 'Personagem 7',
                    'status' => true,
                ],
                [
                    'id' => 8,
                    'personagem' => 'personagem/personagem14.png',
                    'descricao' => 'Personagem 8',
                    'status' => true,
                ],
                [
                    'id' => 9,
                    'personagem' => 'personagem/personagem12.png',
                    'descricao' => 'Personagem 9',
                    'status' => true,
                ],
                [
                    'id' => 10,
                    'personagem' => 'personagem/personagem13.png',
                    'descricao' => 'Personagem 10',
                    'status' => true,
                ],
            )
        );
    }
}
