<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcorreciaveiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorreciaveiculos', function (Blueprint $table) {
            $table->id();
            $table->date('data_ocorrencia');
            $table->date('data_resolucao')->nullable();
            $table->string('descricao_problema');
            $table->string('descricao_solucao')->nullable();
            $table->string('estado');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('veiculo_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
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
        Schema::dropIfExists('ocorreciaveiculos');
    }
}
