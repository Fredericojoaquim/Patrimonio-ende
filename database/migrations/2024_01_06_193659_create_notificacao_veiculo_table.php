<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacaoVeiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacao_veiculo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('veiculo_id');
            $table->string('descricao'); 
            $table->string('estado'); 
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
        Schema::dropIfExists('notificacao_veiculo');
    }
}
