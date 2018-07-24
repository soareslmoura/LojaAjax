<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaProdutos extends Migration
{

    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('estoque');
            $table->float('preco');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
