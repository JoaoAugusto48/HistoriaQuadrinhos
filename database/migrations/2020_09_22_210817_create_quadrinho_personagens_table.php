<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateQuadrinhoPersonagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quadrinhoPersonagens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('balao_esquerda');
            $table->unsignedBigInteger('balao_direita');
            $table->timestamps();

            $table->foreign('balao_esquerda')->references('id')->on('balaos');
            $table->foreign('balao_direita')->references('id')->on('balaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quadrinhoPersonagens');
    }
}
