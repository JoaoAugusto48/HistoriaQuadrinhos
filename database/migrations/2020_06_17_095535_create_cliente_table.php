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
            $table->unsignedBigInteger('estado_id');
            $table->string('status');
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estados');
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
