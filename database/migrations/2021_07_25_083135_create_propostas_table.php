<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propostas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->string('proposta_numero');
            $table->date('data');
            $table->date('data_aprovacao')->nullable();
            $table->string('pagamento');
            $table->string('validade');
            $table->string('entrega')->nullable();
            $table->integer('status')->default(1);
            $table->integer('pendente')->default(1);
            $table->string('endereco_empresa')->nullable();
            $table->string('descricao')->nullable();
            $table->string('nuit')->nullable();
            
            $table->string('nrDocumento')->nullable();
            // Outros
            $table->string('elaborado_por')->nullable();
            $table->string('aprovado_por')->nullable();
            $table->string('editado_por')->nullable();
            $table->string('cancelado_por')->nullable();
            $table->string('impresso')->nullable();
            // Enviado pdf por email
            $table->string('enviado')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
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
        Schema::dropIfExists('propostas');
    }
}
