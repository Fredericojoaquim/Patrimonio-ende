<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacaoResidenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_notificacao_residencia', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('residencia_id');
            $table->string('descricao'); 
            $table->string('estado'); 
            $table->foreign('residencia_id')->references('id')->on('residencia');
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
        Schema::dropIfExists('_notificacao_residencia');
    }
}
