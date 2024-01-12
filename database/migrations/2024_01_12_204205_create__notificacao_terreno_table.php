<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacaoTerrenoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_notificacao_terreno', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('terreno_id');
            $table->string('descricao'); 
            $table->string('estado'); 
            $table->foreign('terreno_id')->references('id')->on('terrenos');
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
        Schema::dropIfExists('_notificacao_terreno');
    }
}
