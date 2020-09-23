<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUtensilioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utensilios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('caminho');
            $table->string('descricao');
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
        Schema::dropIfExists('utensilios');
    }

    private function adicionaDados(){
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
