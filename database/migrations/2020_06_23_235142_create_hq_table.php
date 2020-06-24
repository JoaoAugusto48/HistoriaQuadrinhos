<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('situar_id');
            $table->unsignedBigInteger('problematizar_id');
            $table->unsignedBigInteger('solucionar_id');
            $table->timestamps();

            $table->foreign('situar_id')->references('id')->on('situars');
            $table->foreign('problematizars_id')->references('id')->on('problematizars');
            $table->foreign('solucionars_id')->references('id')->on('solucionars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hqs');
    }
}
