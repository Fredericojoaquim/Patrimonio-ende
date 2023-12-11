<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerrenosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terrenos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('endereco_id')->unsigned();
            $table->string('num_imobilizado');
            $table->string('descricao');
            $table->double('valor_aquisicao')->nullable();
            $table->double('custo_aquisicao_usd')->nullable();
            $table->double('custo_aquisicao_euro')->nullable();
            $table->string('finalidade');
            $table->string('tipo_aquisicao');
            $table->string('dimensao');
            $table->date('data_aquisicao');
            $table->string('estado')->nullable();  
            $table->foreign('endereco_id')->references('id')->on('endereco');
            $table->foreign('tipo_aquisicao')->references('id')->on('tipoaquisicao');
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
        Schema::dropIfExists('terrenos');
    }
}
