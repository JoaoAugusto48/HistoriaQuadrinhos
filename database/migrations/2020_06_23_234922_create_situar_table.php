<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSituarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('situars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('hq_id');
            $table->unsignedBigInteger('quadrinho_id');            
            $table->timestamps();

            $table->foreign('hq_id')->references('id')->on('hqs');
            $table->foreign('quadrinho_id')->references('id')->on('quadrinhos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('situars');
    }
}
