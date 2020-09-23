<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePersonagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personagems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('personagem'); //imagem
            $table->string('descricao', 70);
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
        Schema::dropIfExists('personagems');
    }

    private function adicionaDados(){
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
