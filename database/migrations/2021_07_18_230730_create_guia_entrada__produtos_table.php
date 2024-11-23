<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiaEntradaProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guia_entrada__produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guiaEntrada_id');
            $table->unsignedBigInteger('produto_id');
            // $table->integer('unidade')->nullable();
            $table->double('quantidade')->nullable();
            $table->double('custo_unitario')->nullable();
            $table->double('valor')->nullable();
            $table->integer('status')->default('1');
            // Quantidade total antes de adicioar na aprovacao
            // $table->double('quantidade_aprovado')->nullable();
            $table->foreign('guiaEntrada_id')->references('id')->on('guiadeentradas');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guia_entrada__produtos');
    }
}
