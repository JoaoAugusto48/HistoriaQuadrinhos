<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('privilegio');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $this->adicionaDados();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

    private function adicionaDados(){
        // adicionando dado
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
