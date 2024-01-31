<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoal', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); 
            $table->date('datanasc'); 
            $table->string('email'); 
            $table->string('telefone'); 
            $table->string('funcao'); 
            $table->bigInteger('departamento_id')->nullable();;
            $table->foreign('departamento_id')->references('id')->on('departamentos');
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
        Schema::dropIfExists('pessoal');
    }
}
