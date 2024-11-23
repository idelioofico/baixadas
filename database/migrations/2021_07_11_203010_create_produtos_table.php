<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nome');
            $table->unsignedBigInteger('categoria_id');
            $table->integer('parent_id')->nullable();
            $table->string('unidade_total'); //1 cm/2 m/3 km
            // $table->double('quantidade_total');
            $table->string('localozacao_no_armazem');
            $table->string('imagem')->nullable();
            $table->integer('status')->default(1);

            $table->foreign('categoria_id')->references('id')->on('categorias');
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
        Schema::dropIfExists('produtos');
    }
}
