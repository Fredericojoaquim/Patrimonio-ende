<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacaoEdificioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacao_edificio', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('edificio_id');
            $table->string('descricao'); 
            $table->string('estado'); 
            $table->foreign('edificio_id')->references('id')->on('edificio');
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
        Schema::dropIfExists('_notificacao_edificio');
    }
}
