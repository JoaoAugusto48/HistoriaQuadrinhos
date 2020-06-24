<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('texto', 256);
            $table->unsignedBigInteger('quadrinho_id');
            $table->unsignedBigInteger('personagem_id');
            $table->timestamps();

            $table->foreign('quadrinho_id')->references('id')->on('quadrinhos');
            $table->foreign('personagem_id')->references('id')->on('personagems');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensagems');
    }
}
