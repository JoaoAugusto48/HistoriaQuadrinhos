<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quadrinho_id');
            $table->unsignedBigInteger('utensilio_id');
            $table->timestamps();

            $table->foreign('quadrinho_id')->references('id')->on('quadrinhos');
            $table->foreign('utensilio_id')->references('id')->on('utensilios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objetos');
    }
}
