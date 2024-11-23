<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedorCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor_categorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fornecedor_id');
            $table->unsignedBigInteger('categoria_id');
            $table->integer('parent_id')->nullable();
            $table->integer('status')->default(1);
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors');
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
        Schema::dropIfExists('fornecedor_categorias');
    }
}
