<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome',100);
            $table->string('responsavel',100);
            $table->string('email');
            $table->string('telefone', 14);
            $table->string('cidade', 50);
            $table->string('endereco', 50);
            $table->float('numero', 5,0);
            $table->string('complemento', 30)->nullable();
            $table->boolean('status');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
