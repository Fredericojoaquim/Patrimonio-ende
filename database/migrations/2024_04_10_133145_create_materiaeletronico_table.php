<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaeletronicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiaeletronico', function (Blueprint $table) {
            $table->id();
            $table->string('num_mobilizado');
            $table->string('descricao');
            $table->double('valor_aquisicao')->nullable();
            $table->double('custo_aquisicao_usd')->nullable();
            $table->double('custo_aquisicao_euro')->nullable();
            $table->date('data_aquisicao');
            $table->date('data_utilizacao');
            $table->string('estado');
            $table->string('cor');
            $table->string('marca');
            $table->string('modelo');
            $table->string('tipo');
            $table->string('Ram');
            $table->string('armazenamento');
            $table->bigInteger('vida_util')->nullable();
            $table->bigInteger('tipoaquisicao_id')->unsigned();
            $table->bigInteger('fornecedor_id')->unsigned();
            $table->double('valor_residual')->nullable();
            $table->foreign('tipoaquisicao_id')->references('id')->on('tipoaquisicao');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedor');
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
        Schema::dropIfExists('materiaeletronico');
    }
}
