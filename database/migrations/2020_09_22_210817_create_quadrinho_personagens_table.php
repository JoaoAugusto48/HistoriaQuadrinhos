<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->unsignedBigInteger('balao1_id');
            $table->unsignedBigInteger('balao2_id');
            $table->timestamps();

            $table->foreign('balao1')->references('id')->on('balaos');
            $table->foreign('balao2')->references('id')->on('balaos');
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
