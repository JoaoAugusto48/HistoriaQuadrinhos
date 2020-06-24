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
            $table->string('tema', 100);
            $table->string('local');
            $table->unsignedBigInteger('personagem1');
            $table->unsignedBigInteger('personagem2');
            $table->unsignedBigInteger('ambiente');
            $table->timestamps();

            $table->foreign('personagem1_id')->references('id')->on('personagems');
            $table->foreign('personagem2_id')->references('id')->on('personagems');
            $table->foreign('ambiente_id')->references('id')->on('ambientes');
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
