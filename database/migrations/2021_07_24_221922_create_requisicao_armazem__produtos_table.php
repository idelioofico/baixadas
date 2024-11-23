<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisicaoArmazemProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicao_armazem__produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisicaoArmazem_id');
            $table->unsignedBigInteger('produto_id');
            // $table->double('unidade')->nullable();
            $table->double('quantidade')->nullable();
            $table->double('custo_unitario')->nullable();
            $table->double('valor')->nullable();
            $table->integer('status')->default('1');
            // Quantidade total depois de adicionado(diminuido) na aprovacao
            // $table->double('quantidade_aprovado')->nullable();
            $table->foreign('requisicaoArmazem_id')->references('id')->on('requisicao_armazems');
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
        Schema::dropIfExists('requisicao_armazem__produtos');
    }
}
