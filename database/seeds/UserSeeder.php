<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            array([
                'id' => 1,
                'name' => 'João Augusto',
                'email' => 'jpaiaobonifacio@gmail.com',
                'privilegio' => 1,
                'password' => Hash::make('123123123')
            ],
            [
                'id' => 2,
                'name' => 'João Augusto Paião Bonifácio',
                'email' => 'teste@teste',
                'privilegio' => 1,
                'password' => Hash::make('123123123')
            ]),
        );
    }
}
