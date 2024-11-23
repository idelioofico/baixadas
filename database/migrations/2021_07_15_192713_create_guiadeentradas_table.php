<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiadeentradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guiadeentradas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_do_folheto')->nullable();
            $table->string('codigo_do_folheto')->default('MD057');
            $table->unsignedBigInteger('fornecedor_id')->nullable();
            $table->string('responsavel')->nullable();
            $table->string('numero_da_fatura')->nullable();
            $table->string('packing_list')->nullable();
            $table->string('outros_documentos')->nullable();
            $table->date('data')->nullable();
            $table->date('data_aprovacao')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('pendente')->default('1'); //1 pendente //2 Aprovado //0 cancelado //3 Aprovado e ja usado
            $table->integer('status')->default('1');

            $table->string('nrDocumento')->nullable();
            // Outros
            $table->string('elaborado_por')->nullable();
            $table->string('aprovado_por')->nullable();
            $table->string('editado_por')->nullable();
            $table->string('cancelado_por')->nullable();
            $table->string('impresso')->nullable();

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
        Schema::dropIfExists('guiadeentradas');
    }
}
