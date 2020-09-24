<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuadrinhoPersonagensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quadrinhoPersonagens')->insert(
            array(
                'id' => 1,
                'balao_esquerda' => 4,
                'balao_direita' => 1
            )
        );
    }
}
