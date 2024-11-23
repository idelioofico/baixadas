<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropostaProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposta_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposta_id');
            $table->unsignedBigInteger('produto_id');
            // $table->double('unidade')->nullable();
            $table->double('quantidade')->nullable();
            $table->double('preco_unitario')->nullable();
            $table->double('preco_total')->nullable();
            $table->string('entrega')->nullable();
            $table->integer('status')->default('1');
            $table->foreign('proposta_id')->references('id')->on('propostas');
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
        Schema::dropIfExists('proposta_produtos');
    }
}
