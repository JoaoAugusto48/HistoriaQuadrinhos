<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            array(
                'id' => 1,
                'name' => 'João Augusto',
                'email' => 'teste@teste',
                'privilegio' => 1,
                'password' => '$2y$10$/zpMuglqHXJzD.WZxNu2fumieAv.aL24L6UFfSqjNRQvlWUEY7iLG'
            )
        );
    }
}
