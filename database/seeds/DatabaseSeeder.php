<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AmbienteSeeder::class);
        $this->call(BalaoSeeder::class);
        $this->call(PersonagemSeeder::class);
        $this->call(QuadrinhoPersonagensSeeder::class);
        $this->call(UtensilioSeeder::class);
        $this->call(EstadoSeeder::class);
    }
}
