<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcorrenciaEletronicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencia_eletronico', function (Blueprint $table) {
            $table->id();
            $table->date('data_ocorrencia');
            $table->date('data_resolucao')->nullable();
            $table->string('descricao_problema');
            $table->string('descricao_solucao')->nullable();
            $table->string('estado');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('material_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('material_id')->references('id')->on('materiaeletronico');
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
        Schema::dropIfExists('ocorrencia_eletronico');
    }
}
