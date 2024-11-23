<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiaDeTransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guia_de_transportes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guiaSaida_id');
            $table->string('numero_do_folheto')->nullable();
            $table->string('codigo_do_folheto')->default('MD057');
            $table->string('local_de_descarga');
            $table->string('local_de_carga');
            $table->string('destinatario')->nullable();
            $table->date('data');
            $table->date('data_aprovacao')->nullable();
            $table->string('responsavel')->nullable();
            $table->integer('pendente')->default(1);
            $table->integer('status')->default(1);
            // Carro
            $table->string('nuit_do_destinatario')->nullable();
            $table->string('viatura_marca');
            $table->string('matricula');
            $table->string('motorista')->nullable();
            $table->string('carta_de_conducao')->nullable();
            $table->string('local_de_emissao')->nullable();
            // Nao esquecer data
            $table->date('data_emissao')->nullable();
            
            $table->string('nrDocumento')->nullable();
            // Outros
            $table->string('elaborado_por')->nullable();
            $table->string('aprovado_por')->nullable();
            $table->string('editado_por')->nullable();
            $table->string('cancelado_por')->nullable();
            $table->string('impresso')->nullable();
            $table->foreign('guiaSaida_id')->references('id')->on('guia_de_saidas');
            
            
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
        Schema::dropIfExists('guia_de_transportes');
    }
}
