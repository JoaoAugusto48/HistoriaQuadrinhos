<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmbienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ambientes')->insert(
            array(
                [
                    'id' => 1,
                    'fundo' => 'ambiente/ambiente1.png',
                    'descricao' => 'Cidade',
                    'repeteFundo' => false,
                    'status' => true,
                ],
                [
                    'id' => 2,
                    'fundo' => 'ambiente/ambiente2.png',
                    'descricao' => 'Cidade 2',
                    'repeteFundo' => false,
                    'status' => true,
                ],
                [
                    'id' => 3,
                    'fundo' => 'ambiente/ambiente3.png',
                    'descricao' => 'Casa - Frente',
                    'repeteFundo' => true,
                    'status' => true,
                ],
                [
                    'id' => 4,
                    'fundo' => 'ambiente/ambienteDeTrabalho.png',
                    'descricao' => 'Escritório - Computador',
                    'repeteFundo' => false,
                    'status' => true,
                ],
                [
                    'id' => 5,
                    'fundo' => 'ambiente/ambienteDeTrabalho2.png',
                    'descricao' => 'Casa - Interior',
                    'repeteFundo' => false,
                    'status' => true,
                ],
                [
                    'id' => 6,
                    'fundo' => 'ambiente/ambienteDeTrabalho3.png',
                    'descricao' => 'Escritório',
                    'repeteFundo' => false,
                    'status' => true,
                ],
                [
                    'id' => 7,
                    'fundo' => 'ambiente/ambienteDeTrabalho4.png',
                    'descricao' => 'Escritório 2',
                    'repeteFundo' => false,
                    'status' => true,
                ],
                [
                    'id' => 8,
                    'fundo' => 'ambiente/ambienteDeTrabalho5.png',
                    'descricao' => 'Escritório 3',
                    'repeteFundo' => false,
                    'status' => true,
                ],
                [
                    'id' => 9,
                    'fundo' => 'ambiente/ambienteDeTrabalho6.png',
                    'descricao' => 'Casa - Interior 2',
                    'repeteFundo' => false,
                    'status' => true,
                ],
                [
                    'id' => 10,
                    'fundo' => 'ambiente/ambienteDeTrabalho7.png',
                    'descricao' => 'Hospital',
                    'repeteFundo' => false,
                    'status' => true,
                ]
            )
        );
    }
}
