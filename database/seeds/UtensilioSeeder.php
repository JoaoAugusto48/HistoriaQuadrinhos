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
                    'descricao' => 'cadeira1'
                ],
                [
                    'id' => 2,
                    'caminho' => 'utensilio/utensilio2.png',
                    'descricao' => 'cadeira2'
                ],
                [
                    'id' => 3,
                    'caminho' => 'utensilio/utensilio3.png',
                    'descricao' => 'cadeira3'
                ]
            )
        );
    }
}
