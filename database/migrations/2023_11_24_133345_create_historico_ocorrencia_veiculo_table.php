<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoOcorrenciaVeiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_ocorrencia_veiculo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ocorrencia_id')->unsigned();
            $table->string('solucao');
            $table->date('data');
            $table->foreign('ocorrencia_id')->references('id')->on('ocorreciaveiculos');
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
        Schema::dropIfExists('historico_ocorrencia_veiculo');
    }
}
