<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAmbienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fundo'); //imagem
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
        Schema::dropIfExists('ambientes');
    }

    private function adicionaDados(){
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
