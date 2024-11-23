<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->string('telefone');
            $table->string('nuit');
            $table->string('endereco1')->nullable();
            $table->string('endereco2')->nullable();
            $table->string('representante_do_cliente')->nullable();
            $table->string('email_do_representante')->nullable();
            $table->string('telefone_do_representante')->nullable();
            $table->string('pais')->nullable();
            $table->string('provincia')->nullable();
            $table->integer('status')->default(1);// 1 ativo /0 apagado
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
        Schema::dropIfExists('clientes');
    }
}
