<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacaoMatEletronicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_notificacao_mat_eletronico', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('materiaeletronico_id');
            $table->string('descricao'); 
            $table->string('estado'); 
            $table->foreign('materiaeletronico_id')->references('id')->on('materiaeletronico');
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
        Schema::dropIfExists('_notificacao_mat_eletronico');
    }
}
