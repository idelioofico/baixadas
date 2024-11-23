<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisicaoArmazemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicao_armazems', function (Blueprint $table) {
            $table->id();
            $table->string('numero_do_folheto')->nullable();
            $table->string('codigo_do_folheto')->default('MD001');
            $table->string('aplicacao')->nullable();
            $table->integer('finalidade')->nullable(); //1 cliente /2 Aplicacao ----selecionar
            $table->integer('motivo_de_requisicao')->nullable();
            $table->string('motivo_descricao')->nullable();
            $table->string('requisitante')->nullable();
            $table->date('data');
            $table->time('hora')->nullable();
            $table->string('obs')->nullable();
            $table->integer('pendente')->default(1);
            $table->date('data_aprovacao')->nullable();
            $table->integer('status')->default(1);
            // Assinaturas
            $table->string('laborado_por')->nullable();
            $table->string('autorizado_por')->nullable();
            
            $table->string('nrDocumento')->nullable();
            // Outros
            $table->string('elaborado_por')->nullable();
            $table->string('aprovado_por')->nullable();
            $table->string('editado_por')->nullable();
            $table->string('cancelado_por')->nullable();
            $table->string('impresso')->nullable();
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
        Schema::dropIfExists('requisicao_armazems');
    }
}
