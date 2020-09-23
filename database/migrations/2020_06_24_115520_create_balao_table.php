<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBalaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('caminho');
            $table->string('descricao');
            $table->timestamps();
        });

        $this->adicionarDados();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table');
    }

    private function adicionarDados(){
        // adicionando dado
        DB::table('balaos')->insert(
            array(
                [
                    'id' => 1,
                    'caminho' => 'balao/balaoDireita1.png',
                    'descricao' => 'balao1'
                ],
                [
                    'id' => 2,
                    'caminho' => 'balao/balaoDireita2.png',
                    'descricao' => 'balao2'
                ],
                [
                    'id' => 3,
                    'caminho' => 'balao/balaoEsquerda1.png',
                    'descricao' => 'balao3'
                ],
                [
                    'id' => 4,
                    'caminho' => 'balao/balaoEsquerda2.png',
                    'descricao' => 'balao4'
                ]
            )
        );
    }
}
