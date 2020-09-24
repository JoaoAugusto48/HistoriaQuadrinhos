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
                    'descricao' => 'ambiente1'
                ],
                [
                    'id' => 2,
                    'fundo' => 'ambiente/ambiente2.png',
                    'descricao' => 'ambiente2'
                ],
                [
                    'id' => 3,
                    'fundo' => 'ambiente/ambiente3.png',
                    'descricao' => 'ambiente3'
                ]
            )
        );
    }
}
