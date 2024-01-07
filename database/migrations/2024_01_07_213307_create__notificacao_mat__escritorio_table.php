<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacaoMatEscritorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacao_mat_escritorio', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('material_escritorio_id');
            $table->string('descricao'); 
            $table->string('estado'); 
            $table->foreign('material_escritorio_id')->references('id')->on('materialescritorio');
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
        Schema::dropIfExists('_notificacao_mat__escritorio');
    }
}
