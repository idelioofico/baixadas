<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambios', function (Blueprint $table) {
            $table->id();
            $table->double('metical')->nullable();
            $table->double('rand')->nullable();
            $table->double('dolar')->nullable();
            $table->double('euro')->nullable();
            $table->date('data')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('cambios');
    }
}
