<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiaDeSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guia_de_saidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisicaoArmazem_id')->nullable();
            $table->string('numero_do_folheto')->nullable();
            $table->string('codigo_do_folheto')->default('MD057');
            $table->string('destino_do_material')->nullable();
            $table->string('requisitante')->nullable();
            $table->string('departamento')->nullable();
            $table->string('documentos_assoc')->nullable();
            $table->date('data')->nullable();
            $table->date('data_aprovacao')->nullable();
            $table->integer('pendente')->default(1);
            $table->integer('status')->default(1);
            $table->date('data_do_documento')->nullable();
            $table->date('data_do_fornecimento')->nullable();
            $table->date('data_do_recebimento')->nullable();

            // Assinaturas
            $table->string('levantado_por')->nullable();
            $table->string('fiel_do_armazem')->nullable();
            $table->string('assistente_do_armazem')->nullable();
            
            $table->string('nrDocumento')->nullable();
            // Outros
            $table->string('elaborado_por')->nullable();
            $table->string('aprovado_por')->nullable();
            $table->string('editado_por')->nullable();
            $table->string('cancelado_por')->nullable();
            $table->string('impresso')->nullable();

            $table->foreign('requisicaoArmazem_id')->references('id')->on('requisicao_armazems');
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
        Schema::dropIfExists('guia_de_saidas');
    }
}
